<?php
// Хэрэв session эхлээгүй бол эхлүүлэх
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php'; // Базаас холболт хийх
include 'header.php'; // Header хэсэг оруулах

// Хэрэв хэрэглэгч нэвтрээгүй бол нэвтрэх хуудас руу шилжих
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Хэрэглэгчийн орд болон өнөөдрийн огноо авах
$zodiac = $_SESSION['zodiac_sign'];
$today = date('Y-m-d');

// Өнөөдрийн зурхайг мэдээллийн сангаас авах
$stmt = $pdo->prepare("SELECT daily_horoscope FROM horoscopes WHERE zodiac_sign = ? AND date = ?");
$stmt->execute([$zodiac, $today]);
$data = $stmt->fetch();
?>


<?php
include 'footer.php'; // Footer хэсэг оруулах
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <section id="home" class="hero-section">
        <div class="hero-content">
            <h1>Ордын зурхайн ертөнцөд тавтай морил!</h1>
            <p>Бид танд өөрийн ордын талаарх бүхий л мэдээлэл, зурхай, нийцэл болон бусад сонирхолтой зүйлсийг хүргэхэд бэлэн байна.</p>
            <a href="#" class="button-gold">Өнөөдрийн зурхайг харах</a>

            
        </div>
    </section>
</body>
</html>