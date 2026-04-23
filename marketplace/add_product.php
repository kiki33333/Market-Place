<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST["nazwa"];
    $opis = $_POST["opis"];
    $cena = $_POST["cena"];
    $user_id = $_SESSION["user_id"];

    $sql = "INSERT INTO produkty (nazwa, opis, cena, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $nazwa, $opis, $cena, $user_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Błąd dodawania produktu";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj produkt</title>
    <link rel="stylesheet" href="styl1.css">
</head>
<body>
    <main>
        <section class="lewy">

<form method="post" onsubmit="return sprawdzProdukt()">
      <h2>Dodaj produkt</h2> <br>
    <input type="text" name="nazwa" id="nazwa" placeholder="Nazwa produktu" required><br><br>
    <textarea name="opis" id="opis" placeholder="Opis produktu" required></textarea><br><br>
    <input type="number" name="cena" id="cena" placeholder="Cena" step="0.01" required><br><br>
    <button type="submit">Dodaj</button>
</form>

</section>
<section class="prawy">
    <img src="prawyjpg.jpg" alt="">

</section>
</main>
    
</body>
</html>


