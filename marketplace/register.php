<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $email = $_POST["email"];
    $haslo = password_hash($_POST["haslo"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO uzytkownicy (login, email, haslo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $login, $email, $haslo);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        echo "Once again...";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
    <section class="form-box">
        <form method="post">
            <h2>Załóż konto</h2>

            <input type="text" name="login" placeholder="Login" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="haslo" placeholder="Hasło" required>

            <button type="submit">Zarejestruj</button>

            <p class="link-text">
                Masz już konto?
                <a href="login.php">Zaloguj się</a>
            </p>
        </form>
    </section>
</main>
    
</body>
</html>



