<?php
session_start();
include "db.php";

$result = $conn->query("SELECT login, email FROM uzytkownicy");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista użytkowników</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <main>
         <section class="napis">
              <h2>Lista <br>użytkowników</h2>
              <a href="index.php">Powrót</a>
        </section>
       <section class="informacja">
        <section class="users">

<?php 
while ($row = $result->fetch_assoc()) {
    echo "<p>";
    echo "Login: " . $row['login'] .  "<br>";
    echo "Email: " . $row['email'].  "<br>".  "<br>";
    echo "</p>";
}
?>
 
</section>
</section>

</main>
</body>
</html>

