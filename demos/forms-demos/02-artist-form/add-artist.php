<?php
// Simple logging of artist form data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $artistName = $_POST['artistName'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $country = $_POST['country'] ?? '';
    $songTitle = $_POST['songTitle'] ?? '';
    $duration = $_POST['duration'] ?? '';
    
    // Create log entry
    $logEntry = date('Y-m-d H:i:s') . ' | Artist: ' . $artistName . 
                ' | Genre: ' . $genre . 
                ' | Country: ' . $country . 
                ' | Song: ' . $songTitle . 
                ' | Duration: ' . $duration . " min\n";
    
    // Log to file
    file_put_contents('artist-log.txt', $logEntry, FILE_APPEND);
    
    // Display confirmation
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Submitted</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 500px;
                margin: 50px auto;
                padding: 20px;
                background-color: #f0f0f0;
            }
            .confirmation {
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                border: 2px solid #00aa00;
            }
            h1 {
                color: #00aa00;
            }
            .data {
                background-color: #f9f9f9;
                padding: 15px;
                border-left: 4px solid #00aa00;
                margin: 15px 0;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #0066cc;
                color: white;
                text-decoration: none;
                border-radius: 3px;
            }
            a:hover {
                background-color: #0052a3;
            }
        </style>
    </head>
    <body>
        <div class="confirmation">
            <h1>✓ Submitted Successfully</h1>
            <div class="data">
                <strong>Artist Name:</strong> <?php echo htmlspecialchars($artistName); ?><br>
                <strong>Genre:</strong> <?php echo htmlspecialchars($genre); ?><br>
                <strong>Country:</strong> <?php echo htmlspecialchars($country); ?><br>
                <strong>Song Title:</strong> <?php echo htmlspecialchars($songTitle); ?><br>
                <strong>Duration:</strong> <?php echo htmlspecialchars($duration); ?> min
            </div>
            <a href="index.html">Add Another Artist</a>
        </div>
    </body>
    </html>
    <?php
} else {
    header('Location: index.html');
}
?>
