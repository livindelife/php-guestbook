<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guestbook</title>
</head>
<body>
    <h1>Guestbook</h1>

<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=oop_php_course', 'root', '');
    $sql = 'SELECT * FROM guestbook ORDER BY date DESC';
    $result = $db->query($sql);
foreach ($result as $row) {
    printf('<p><a href=“mailto:%s”>%s</a> schrieb am/um %s:</p><h3>%s</h3><p>%s</p><hr noshade=“noshade” />',
        urlencode($row['email']),
        htmlspecialchars($row['author']),
        htmlspecialchars($row['date']),
        htmlspecialchars($row['title']),
        nl2br(htmlspecialchars($row['comment']))
        );
    }
} catch (PDOException $e) {
    echo 'Fehler: ' . htmlspecialchars($e->getMessage());
}
?>
    
</body>
</html>

