<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];

    $sql = "SELECT * FROM uzytkownicy WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($haslo, $user["haslo"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["login"] = $user["login"];
        header("Location: index.php");
        exit;
    } else {
        echo "Niepoprawny login lub hasło";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARKETPLACE | Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <section class="form-box">
        <form method="post">
            <h2>Witaj ponownie</h2>

            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="haslo" placeholder="Hasło" required>

            <button type="submit">Zaloguj</button>

            <p class="link-text">Nie masz konta? <a href="register.php">Zarejestruj się</a> </p>
        </form>
    </section>
</main>

</body>
</html>