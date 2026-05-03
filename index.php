<?php

header('Location: home.php');

// DigitalOcean App Platform injects DB credentials automatically 
$host = '127.0.0.1'; //getenv('DB_HOST');
$port = '3306';//getenv('DB_PORT');
$user = 'root';//getenv('DB_USERNAME');
$pass = '';//getenv('DB_PASSWORD');
$dbname = 'WebSystems2Local';//getenv('DB_DATABASE');

echo "<h1>Web Systems II test</h1>";

// 1. Check PHP version
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";

// 2. Try Database Connection
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];
    
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // --- Create table if it doesn't exist ---
    $pdo->exec("CREATE TABLE IF NOT EXISTS user_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        deleted_at TIMESTAMP NULL DEFAULT NULL
    )");

    // Attempt to add deleted_at column if updating an existing older table
    try {
        $pdo->exec("ALTER TABLE user_messages ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL");
    } catch (\PDOException $e) {
        // Column likely already exists, proceed normally
    }

    // --- AUTOMATIC CLEANUP: Hard delete messages soft-deleted over 30 days ago ---
    $pdo->exec("DELETE FROM user_messages WHERE deleted_at IS NOT NULL AND deleted_at < NOW() - INTERVAL 30 DAY");

    // --- Handle Form Submissions (Add, Edit, Delete, Recover) ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? 'add';
        $id = $_POST['id'] ?? null;
        
        if ($action === 'add') {
            $name = $_POST['name'] ?? '';
            $message = $_POST['message'] ?? '';
            if (!empty($name) && !empty($message)) {
                $stmt = $pdo->prepare("INSERT INTO user_messages (name, message) VALUES (:name, :message)");
                $stmt->execute(['name' => $name, 'message' => $message]);
                echo "<p style='color: blue;'>✅ Message successfully saved!</p>";
            } else {
                echo "<p style='color: red;'>❌ Please fill out both the name and message fields.</p>";
            }
        } 
        elseif ($action === 'edit' && $id) {
            $newMessage = $_POST['new_message'] ?? '';
            if (!empty($newMessage)) {
                $stmt = $pdo->prepare("UPDATE user_messages SET message = :message WHERE id = :id");
                $stmt->execute(['message' => $newMessage, 'id' => $id]);
                echo "<p style='color: blue;'>✏️ Message updated!</p>";
            }
        }
        elseif ($action === 'delete' && $id) {
            // Soft Delete: Just set the deleted_at timestamp
            $stmt = $pdo->prepare("UPDATE user_messages SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id");
            $stmt->execute(['id' => $id]);
            echo "<p style='color: orange;'>🗑️ Message moved to trash (kept for 30 days).</p>";
        }
        elseif ($action === 'recover' && $id) {
            // Recover: Nullify the deleted_at timestamp
            $stmt = $pdo->prepare("UPDATE user_messages SET deleted_at = NULL WHERE id = :id");
            $stmt->execute(['id' => $id]);
            echo "<p style='color: green;'>♻️ Message recovered!</p>";
        }
    }

    // --- Display the HTML Form ---
    echo "
    <hr>
    <h2>Add a Message</h2>
    <form method='POST' action=''>
        <input type='hidden' name='action' value='add'>
        <p>
            <label for='name'><strong>Name:</strong></label><br>
            <input type='text' id='name' name='name' required>
        </p>
        <p>
            <label for='message'><strong>Message:</strong></label><br>
            <textarea id='message' name='message' rows='4' required></textarea>
        </p>
        <button type='submit'>Submit</button>
    </form>
    <hr>
    ";

    // --- Fetch and Display Data from the Database ---
    echo "<h2>Saved Messages</h2>";
    // We select ALL messages, but we will display them differently if they are soft-deleted
    $stmt = $pdo->query("SELECT * FROM user_messages ORDER BY created_at DESC");
    $messages = $stmt->fetchAll();

    if ($messages) {
        echo "<ul style='list-style-type: none; padding: 0;'>";
        foreach ($messages as $row) {
            $safeName = htmlspecialchars($row['name']);
            $safeMessage = htmlspecialchars($row['message']);
            $date = date('F j, Y, g:i a', strtotime($row['created_at']));
            $isDeleted = !is_null($row['deleted_at']);
            
            if ($isDeleted) {
                // Calculation for 30-day retention UI
                $deletedDate = strtotime($row['deleted_at']);
                $retentionEnd = date('M j, Y', strtotime('+30 days', $deletedDate));
                
                echo "<li style='color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px; opacity: 0.7;'>";
                echo "<strong>{$safeName}</strong>'s message was deleted. <br>";
                echo "<em>(Retaining until {$retentionEnd})</em><br><br>";
                
                // Recover Button
                echo "<form method='POST' style='display:inline;'>
                        <input type='hidden' name='action' value='recover'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit'>Recover Message</button>
                      </form>";
                echo "</li>";
            } else {
                // Normal Active Message
                echo "<li style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
                echo "<strong>{$safeName}</strong> said: <em>\"{$safeMessage}\"</em> <br>";
                echo "<small style='color: gray;'>(Submitted: {$date} UTC)</small><br><br>";
                
                // Edit & Delete Action Row
                echo "<div style='display: flex; gap: 10px; align-items: center;'>";
                
                // Delete Button
                echo "<form method='POST' style='margin: 0;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit' style='color: red;'>Delete</button>
                      </form>";
                
                // Edit Toggle (Uses HTML <details> for a clean inline edit without JS)
                echo "<details>
                        <summary style='cursor: pointer; color: blue;'>Edit</summary>
                        <form method='POST' style='margin-top: 5px;'>
                            <input type='hidden' name='action' value='edit'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <input type='text' name='new_message' value='{$safeMessage}' required>
                            <button type='submit'>Save Changes</button>
                        </form>
                      </details>";
                      
                echo "</div>";
                echo "</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>No messages found in the database yet.</p>";
    }

} catch (\PDOException $e) {
    echo "<p style='color: red;'>❌ Database Connection Failed: " . $e->getMessage() . "</p>";
}

// 3. Show Apache info
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<footer>Contributors: Aram A., Juan P., Hayden G.</footer>"
?>
