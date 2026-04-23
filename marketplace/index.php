<?php
session_start();
include "db.php";

$sql = "SELECT produkty.*, uzytkownicy.login 
        FROM produkty 
        JOIN uzytkownicy ON produkty.user_id = uzytkownicy.id
        ORDER BY data_dodania DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARKETPLACE | Strona główna</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<nav class="menu">
    <?php if (isset($_SESSION["user_id"])): ?>
        <span>Zalogowano jako: <?php echo $_SESSION["login"]; ?></span>
        <a href="add_product.php">Dodaj produkt</a>
        <a href="users.php">Lista użytkowników</a>
        <a href="logout.php">Wyloguj</a>
    <?php else: ?>
        <a href="login.php">Zaloguj</a>
        <a href="register.php">Rejestracja</a>
    <?php endif; ?>
</nav>

<main>
    <section class="products">
        <?php while ($row = $result->fetch_assoc()): ?>
            <article class="product-card">
                <h3><?php echo $row["nazwa"]; ?></h3>

                <p><?php echo $row["opis"]; ?></p>

                <p><b>Cena:</b> <?php echo $row["cena"]; ?> zł</p>
                <p><b>Autor:</b> <?php echo $row["login"]; ?></p>

                <p class="status <?php echo $row["status"]; ?>">
                    Status: <?php echo $row["status"]; ?>
                </p>

                <?php if (
                    isset($_SESSION["user_id"]) &&
                    $row["status"] == "dostepny" &&
                    $row["user_id"] != $_SESSION["user_id"]
                ): ?>
                    <a 
                        class="buy-btn" 
                        href="buy.php?id=<?php echo $row["id"]; ?>" 
                        onclick="return confirm('Czy na pewno chcesz kupić ten produkt?')"
                    >
                        Kup produkt
                    </a>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </section>
</main>

</body>
</html>