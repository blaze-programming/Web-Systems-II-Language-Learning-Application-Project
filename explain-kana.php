<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What is Kana</title>
    <link rel="stylesheet" href="global-styles.css">
    <style>
        .video-container {
            border: 4px solid #ffffff;
            aspect-ratio: 16 / 9;
            background-color: #0a0d12;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 80px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }

        .video-container:hover {
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        }

        /* Embedded video iframe styling */
        .video-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Video placeholder styling (when no video is embedded) */
        .video-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .play-button {
            width: 100px;
            height: 100px;
            border: 3px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .play-button:hover {
            transform: scale(1.1);
        }

        .play-button::after {
            content: '';
            width: 0;
            height: 0;
            border-left: 30px solid #ffffff;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            margin-left: 6px;
        }

        .video-text {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 300;
            letter-spacing: 1px;
            text-align: center;
        }

        .explanation {
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 300;
            text-align: center;
            line-height: 1.4;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {

            .video-container {
                margin-bottom: 50px;
            }

            .play-button {
                width: 70px;
                height: 70px;
                margin-bottom: 30px;
            }

            .play-button::after {
                border-left: 20px solid #ffffff;
                border-top: 15px solid transparent;
                border-bottom: 15px solid transparent;
            }

            .video-text {
                font-size: 1.3rem;
            }

            .explanation {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="dark-mode">
    <div class="container">
        <?php 
            $pageTitle = "What is Kana";
            include 'menu-bar.php'; 
        ?>

<!--
        <div class="header">
            <div class="settings-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m5.08 5.08l4.24 4.24M1 12h6m6 0h6M4.22 19.78l4.24-4.24m5.08-5.08l4.24-4.24M19.78 19.78l-4.24-4.24m-5.08-5.08l-4.24-4.24"></path>
                </svg>
            </div>
            <h1>What is kana</h1>
        </div>
-->
        <!-- VIDEO CONTAINER - Modify the videoUrl below to add your external video link -->
        <a href="https://www.youtube.com/embed/YOUR_VIDEO_ID" class="video-container" id="videoLink">
            <div class="video-content">
                <div class="play-button"></div>
                <div class="video-text">Maybe External Video</div>
            </div>
        </a>

        <p class="explanation">
            Explanation of what kana is,<br>
            the difference between<br>
            katakana; hiragana; and kanji,<br>
            and what these exercise<br>
            are trying to achieve
        </p>
    </div>

    <script>
        // Configuration: Add your video links here
        const videoConfig = {
            // For YouTube videos, use the embed URL format:
            // https://www.youtube.com/embed/VIDEO_ID
            youtubeVideoId: 'dQw4w9WgXcQ', // Replace with your YouTube video ID
            
            // Or use a direct embed link:
            // embedLink: 'https://www.youtube.com/embed/dQw4w9WgXcQ'
        };

        // Build the YouTube embed URL
        const embedUrl = `https://www.youtube.com/embed/${videoConfig.youtubeVideoId}`;

        // Get the video link element
        const videoLink = document.getElementById('videoLink');
        const videoContent = videoLink.querySelector('.video-content');

        // Function to embed the video
        function embedVideo() {
            // Remove the placeholder content
            videoContent.remove();

            // Create and add the iframe
            const iframe = document.createElement('iframe');
            iframe.src = embedUrl;
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;

            videoLink.appendChild(iframe);
        }

        // Call the function on page load
        embedVideo()
    </script>
</body>

</html>



