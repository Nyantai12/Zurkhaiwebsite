<?php
include 'header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']); 

?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B&N Зурхай</title>
    <link rel="stylesheet" href="assets/css/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
       
    </style>
</head>
<body>
<header>
    <h1>B&N Зурхай</h1>
    <nav>
    <ul>
        <li><a href="index.php" class="<?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>">Нүүр</a></li>
        <li><a href="todayzurkhai.php" class="<?php echo ($currentPage == 'todayzurkhai.php') ? 'active' : ''; ?>">Өнөөдрийн зурхай</a></li>
        <li><a href="personality.php" class="<?php echo ($currentPage == 'personality.php') ? 'active' : ''; ?>">Ордын зан чанар</a></li>
        <li><a href="compatibility.php" class="<?php echo ($currentPage == 'compatibility.php') ? 'active' : ''; ?>">Хос нийцэл</a></li>
        <li><a href="zodiac_history.php" class="<?php echo ($currentPage == 'zodiac_history.php') ? 'active' : ''; ?>">Зурхайн түүх</a></li>
        <li><a href="starmap.php" class="<?php echo ($currentPage == 'starmap.php') ? 'active' : ''; ?>">Одны зураглал</a></li>
    </ul>
</nav>
    <div class="user-info">
        <a href="save.php">PR</a>
        Сайн байна уу, <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong>! 👋 
        <a href="logout.php" class="logout-btn">Гарах</a>
    </div>
</header>
