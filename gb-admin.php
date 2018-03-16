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
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    if (isset($_GET['ok'])) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=oop_php_course', 'root', '');
        $sql = 'DELETE FROM guestbook WHERE id=?';
        $values = array($_GET['id']);
        $com = $db->prepare($sql);
        $com->execute($werte);
        echo '<p>Eintrag gel&ouml;scht.</p><p><a href="gb-admin.php">Zur&uuml;ck zur &Uuml;bersicht</a> </p>';
    } catch (PDOException $e) {
        echo 'Fehler: ' . htmlspecialchars($e->getMessage());
    }
    } else {
        printf('<a href="gb-admin.php?id=%s&ok=1">Wirklich l&ouml;schen? </a>',
        urlencode($_GET['id']));
        }
} else {
    try {
        $db = new PDO('mysql:host=localhost;dbname=oop_php_course', 'root', '');
        $sql = 'SELECT * FROM guestbook ORDER BY date DESC';
        $result = $db->query($sql);
        foreach ($result as $row) {
            printf('<p><b><a href="gb-admin.php?id=%s">Diesen Eintrag l&ouml;schen</a>
            - <a href="gb-edit.php?id=%s"> Diesen Eintrag &auml;ndern</a></b></p>
            <p><a href="mailto:%s">%s</a> schrieb am/um %s:</p>
            <h3>%s</h3><p>%s</p><hr noshade="noshade" />',
            urlencode($row['id']),
            urlencode($row['id']),
            htmlspecialchars($row['email']),
            htmlspecialchars($row['author']),
            htmlspecialchars($row['date']),
            htmlspecialchars($row['title']),
            nl2br(htmlspecialchars($row['comment']))
        );
    }
    } catch (PDOException $e) {
    echo 'Fehler: ' . htmlspecialchars($e->getMessage());
    }
    }
?>

</body>
</html>