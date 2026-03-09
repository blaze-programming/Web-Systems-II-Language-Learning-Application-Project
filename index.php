<?php
// DigitalOcean App Platform injects DB credentials automatically 
// if you've added a database component to your app.
// Note: Replace 'db' with the actual name you gave your database component.

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$dbname = getenv('DB_DATABASE');

echo "<h1>Web Systems II test</h1>";

// 1. Check PHP version
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";

// 2. Try Database Connection
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // This line is crucial for DigitalOcean Managed Databases:
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];
    
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // --- NEW: Create table if it doesn't exist ---
    $pdo->exec("CREATE TABLE IF NOT EXISTS user_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // --- NEW: Handle Form Submission ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Grab data from the form
        $name = $_POST['name'] ?? '';
        $message = $_POST['message'] ?? '';

        if (!empty($name) && !empty($message)) {
            // Prepare and execute the INSERT statement to prevent SQL injection
            $stmt = $pdo->prepare("INSERT INTO user_messages (name, message) VALUES (:name, :message)");
            $stmt->execute(['name' => $name, 'message' => $message]);
            echo "<p style='color: blue;'>✅ Message successfully saved!</p>";
        } else {
            echo "<p style='color: red;'>❌ Please fill out both the name and message fields.</p>";
        }
    }

    // --- NEW: Display the HTML Form ---
    echo "
    <hr>
    <h2>Add a Message</h2>
    <form method='POST' action=''>
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

    // --- NEW: Fetch and Display Data from the Database ---
    echo "<h2>Saved Messages</h2>";
    $stmt = $pdo->query("SELECT * FROM user_messages ORDER BY created_at DESC");
    $messages = $stmt->fetchAll();

    if ($messages) {
        echo "<ul>";
        foreach ($messages as $row) {
            // htmlspecialchars() prevents Cross-Site Scripting (XSS) by neutralizing HTML tags
            $safeName = htmlspecialchars($row['name']);
            $safeMessage = htmlspecialchars($row['message']);
            $date = date('F j, Y, g:i a', strtotime($row['created_at']));
            
            echo "<li><strong>{$safeName}</strong> said: <em>\"{$safeMessage}\"</em> <br><small>(Submitted: {$date} UTC)</small></li><br>";
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
echo "<footer>Contributers: Aram A.,Juan P,Hayden G.</footer>"
?>
