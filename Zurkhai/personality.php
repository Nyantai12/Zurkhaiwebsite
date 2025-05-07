<?php
include 'header.php';
$zodiac = $_SESSION['zodiac_sign'];

$imagePath = "assets/images/" . strtolower($zodiac) . ".png";
// Өгөгдлийн сангийн холболт
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = 'zurkhaidb';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Холболт амжилтгүй: " . $e->getMessage();
    exit;
}

// Ордын зан чанарыг авах функц
function getPersonality($zodiac, $pdo) {
    $sql = "SELECT traits FROM personality_traits WHERE zodiac_sign = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$zodiac]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $row ? $row['traits'] : 'Энэ ордын зан чанар мэдээлэлгүй.';
}

$personality = getPersonality($zodiac, $pdo);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<section class="personality-section" style=" margin-top:50px">
    <h2>Ордын зан чанар</h2>
    <div >
    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Ордын зураг" style="width: 300px; height: 300px; object-fit: contain;">
    <h1 style="font-size:35px"><?php echo htmlspecialchars($zodiac); ?></h1>
    </div>
    <div class="section-content">
        <p ><?php echo $personality; ?></p> <!-- Баазаас авсан зан чанар -->
        <a href="otherpersonality.php" class="learn-more-button" style="margin-top:20px">Бусад ордуудын зан чанар харах</a>
    </div>
</section>


