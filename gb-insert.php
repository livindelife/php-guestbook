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
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['title']) && isset($_POST['comment'])){

    try {
        $db = new PDO('mysql:host=localhost;dbname=oop_php_course', 'root', '');
        $sql = 'INSERT INTO guestbook (title, comment, author, email) VALUES (?,?,?,?)';
        $values = array(
            $_POST['title'],
            $_POST['comment'],
            $_POST['name'],
            $_POST['email'],
        );
        $com = $db->prepare($sql);
        $com->execute($values);
        echo 'comment added';
    } catch(PDOException $e){
        echo 'error: ' . htmlspecialchars($e->getMessage());
    }

} else echo 'error error error';

?>

<form action="" method="post">
    <label for="name">Name</label>
    <input type="text" name="name"><br>
    <label for="name">Email</label>
    <input type="text" name="email"><br>
    <label for="title">Title</label>
    <input type="text" name="title"><br>
    <label for="comment">Comment</label>
    <textarea name="comment" cols="30" rows="10"></textarea><br>
    <input type="submit" name="submit" value="Submit">    
</form>
    
</body>
</html>

