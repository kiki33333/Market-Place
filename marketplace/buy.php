<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$produkt_id = $_GET["id"];
$kupujacy_id = $_SESSION["user_id"];

$sql = "SELECT * FROM produkty WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $produkt_id);
$stmt->execute();
$result = $stmt->get_result();
$produkt = $result->fetch_assoc();

if (!$produkt) {
    die("Produkt nie istnieje");
}

if ($produkt["user_id"] == $kupujacy_id) {
    die("Nie możesz kupić własnego produktu");
}

if ($produkt["status"] == "sprzedany") {
    die("Ten produkt został już sprzedany");
}

$sql = "INSERT INTO zakupy (produkt_id, kupujacy_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $produkt_id, $kupujacy_id);
$stmt->execute();

$sql = "UPDATE produkty SET status = 'sprzedany' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $produkt_id);
$stmt->execute();

header("Location: index.php");
exit;
?>