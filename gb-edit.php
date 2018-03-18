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
  $name = "";
  $email = "";
  $title = "";
  $comment = "";

  if (isset($_GET["id"]) &&
      is_numeric($_GET["id"])) {

    try {
        $db = new PDO('mysql:host=localhost;dbname=oop_php_course', 'root', '');
      if (isset($_POST["name"]) &&
          isset($_POST["email"]) &&
          isset($_POST["title"]) &&
          isset($_POST["comment"])) {
        $sql = "UPDATE guestbook SET title = ?, comment = ?, author = ?, email = ? WHERE id=?";
        $values = array(
          $_POST["title"], 
          $_POST["comment"], 
          $_POST["name"], 
          $_POST["email"], 
          $_GET["id"] 
        );
        $com = $db->prepare($sql);
        $com->execute($values);
        echo '<p> Eintrag ge&auml;ndert.</p><p><a href="gb-admin.php">Zur&uuml;ck zur &Uuml;bersicht</a></p>';
      }

      $sql = "SELECT * FROM gaestebuch WHERE id=?";
      $com = $db->prepare($sql);
      $value = array($_GET["id"]);
      $com->execute($value);
      if ($row = $com->fetchObject()) {
          $name = $row->autor;
          $email = $row->email;
          $title = $row->title;
          $comment = $row->eintrag;
      }
    } catch (PDOException $e) {
      echo 'Error: ' . htmlspecialchars($e->getMessage());
    }
  }
?>
<form action="" method="post">
    <label for="name">Name</label>
    <input type="text" name="name" "<?php echo htmlspecialchars($name);?>"><br>
    <label for="name">email</label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email);?>"><br>
    <label for="title">Title</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($title);?>"><br>
    <label for="comment">Comment</label>
    <textarea name="comment" cols="30" rows="10"><?php echo htmlspecialchars($comment);?></textarea><br>
    <input type="submit" name="submit" value="Update">    
</form>

</body>
</html>