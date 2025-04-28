<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Хэрэглэгчийн мэдээллийг харуулах
echo "<h2>Таны мэдээлэл</h2>";
echo "Нэр: " . $_SESSION['name'] . "<br>";
echo "Имэйл: " . $_SESSION['email'] . "<br>";
echo "Орд: " . $_SESSION['zodiac_sign'] . "<br>";
echo "<a href='logout.php'>Гарах</a>";


?>
