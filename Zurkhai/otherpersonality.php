<?php
include 'header.php';

// Session шалгах
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// DB холболт
include 'db.php';

// Бүх ордуудын зан чанарыг авах
$stmt = $pdo->query("SELECT zodiac_sign, traits FROM personality_traits");
$personalities = $stmt->fetchAll();

// Ордын зургууд
$zodiacImages = [
    "Хонь" => "Хонь.png",
    "Үхэр" => "Үхэр.png",
    "Ихэр" => "Ихэр.png",
    "Мэлхий" => "Мэлхий.png",
    "Арслан" => "Арслан.png",
    "Охин" => "Охин.png",
    "Жинлүүр" => "Жинлүүр.png",
    "Хилэнц" => "Хилэнц.png",
    "Нум" => "Нум.png",
    "Матар" => "Матар.png",
    "Хумх" => "Хумх.png",
    "Загас" => "Загас.png"
];
?>

<!-- Animate.css болон AOS animation оруулах -->
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
.zodiac-card {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    background: 'transparent';
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    margin: 50px auto;
    max-width: 1400px;
    height:500px
}
.zodiac-card:hover {
    transform: scale(1.03);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}
.zodiac-image img {
    width: 100%;
    height: auto;
    object-fit: contain;
}
.zodiac-info {
    padding: 30px;
}
.zodiac-info h2 {
    font-size: 60px;
    margin-bottom: 20px;
    font-weight: bold;
}
.zodiac-info p {
    font-size: 25px;
    line-height: 1.7;
    font-weight:bold;
}
@media (max-width: 768px) {
    .zodiac-card {
        flex-direction: column;
    }
}
</style>
</head>

<section id="all-personality" style="margin-top: 50px;">
    <h2 style="text-align:center; font-size: 45px; margin-bottom:50px;" class="animate__animated animate__fadeInDown">Бүх Ордуудын Зан Чанар</h2>

    <?php if ($personalities): ?>
        <?php foreach ($personalities as $index => $personality): ?>
            <?php 
                $zodiacSign = htmlspecialchars($personality['zodiac_sign']);
                $traits = htmlspecialchars($personality['traits']);
                $imageFile = isset($zodiacImages[$zodiacSign]) ? $zodiacImages[$zodiacSign] : "default.png";
            ?>

            <div class="zodiac-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>" style="display: flex; align-items: center; gap: 30px;">
                <!-- Зураг -->
                <div class="zodiac-image" style="flex: 0 0 450px; text-align: center;">
                    <img src="assets/images/<?php echo $imageFile; ?>" alt="<?php echo $zodiacSign; ?>">
                </div>

                <!-- Текст -->
                <div class="zodiac-info" style="flex: 1;">
                    <h2 data-aos="zoom-in" data-aos-delay="200"><?php echo $zodiacSign; ?></h2>
                    <p data-aos="fade-left" data-aos-delay="300" style="margin-top: 20px; font-size:18px">Ордын зан чанар:</p>
                    <p data-aos="fade-left" data-aos-delay="300">"<?php echo nl2br($traits); ?>"</p>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center;">Ордуудын зан чанарын мэдээлэл олдсонгүй. 🙏</p>
    <?php endif; ?>

    <div style="text-align: center; margin: 50px 0;">
        <a href="personality.php" class="learn-more-button" style="display: inline-block; padding: 12px 30px; background: #e9c65e; color: #212121; text-decoration: none; border-radius: 8px; font-size: 1.2rem; font-weight:bold;">Буцах</a>
    </div>
</section>

<!-- AOS animation script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true,
  });
</script>

