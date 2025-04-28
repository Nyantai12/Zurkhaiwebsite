<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $birthDate = $_POST['birth_date'];
    $zodiac = getZodiacSign($birthDate);

    echo "<h2>🔮 Төрсөн өдрийн шинжилгээ</h2>";
    echo "<p>Таны төрсөн огноо: " . htmlspecialchars($birthDate) . "</p>";
    echo "<p>Таны орд: $zodiac</p>";

    // Ордын шинжилгээ, дүрсийг нэмэх, тодорхойлолт гаргах
    echo "<p>Зурхай дахь таны ордын шинжилгээ...</p>"; // Тодорхой шинжилгээ болон нэмэлт текст оруулна.
}
?>

<h2>Төрсөн өдрийн шинжилгээ</h2>
<form method="POST">
    Төрсөн огноо: <input type="date" name="birth_date" required><br>
    <button type="submit">Шинжилгээ хийх</button>
</form>

