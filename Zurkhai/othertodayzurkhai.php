<?php
include 'header.php';

// Session шалгах
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// DB холболт
include 'db.php';

$today = date('Y-m-d');

// Бүх ордын өнөөдрийн зурхай авах
$stmt = $pdo->prepare("SELECT zodiac_sign, daily_horoscope FROM horoscopes WHERE date = ?");
$stmt->execute([$today]);
$horoscopes = $stmt->fetchAll();

// Ордын зургуудыг хадгалах (файлын нэрийг ордын нэртэй тааруулж болно)
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
<!-- AOS Animation CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- AOS Animation JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
  AOS.init({
    duration: 1200, 
    once: true,    
  });
</script>


<section id="all-zurkhai" class="all-zurkhai-section">
    <h2 style="margin-top: 50px; text-align:center; font-size: 40px;">Бүх Ордын Өнөөдрийн Зурхай</h2>

    <?php if ($horoscopes): ?>
        <?php 
        $animations = ['fade-right', 'fade-left', 'zoom-in', 'flip-up', 'fade-up', 'fade-down']; 
        $durations = [1000, 1200, 1500, 1800]; 
        $index = 0; 
        ?>

        <?php foreach ($horoscopes as $horoscope): ?>
            <?php 
                $zodiacSign = htmlspecialchars($horoscope['zodiac_sign']);
                $imageFile = isset($zodiacImages[$zodiacSign]) ? $zodiacImages[$zodiacSign] : "default.png";
                
                // Animation сонгох
                $animation = $animations[$index % count($animations)];
                $duration = $durations[$index % count($durations)];
                $delay = ($index * 100) % 500; 
            ?>

            <section class="zodiac-section" 
                data-aos="<?php echo $animation; ?>" 
                data-aos-duration="<?php echo $duration; ?>"
                data-aos-delay="<?php echo $delay; ?>"
                style="height:500px; display: flex; align-items: center; justify-content: center; gap: 40px; margin: 60px 0; padding: 30px; background: transparent; border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
            >
                <!-- Зураг -->
                <div class="zodiac-image" style="flex: 0 0 400px; text-align: center; margin-left:80px">
                    <img src="assets/images/<?php echo $imageFile; ?>" alt="<?php echo $zodiacSign; ?>" style="width: 450px; height: auto; border-radius: 10px;">
                </div>

                <!-- Текст -->
                <div class="zodiac-info" style="flex: 1;">
                    <h2 style="font-size: 66px; margin-bottom: 20px; margin-left:60px"><?php echo $zodiacSign; ?></h2>
                    <p style="margin-top: 20px; font-size:18px">Таны өнөөдрийн зурхай:</p>
                    <p style="font-size:30px; font-weight:bold; line-height: 1.6;">"<?php echo nl2br(htmlspecialchars($horoscope['daily_horoscope'])); ?>"</p>
                </div>
            </section>

            <?php $index++; ?>
        <?php endforeach; ?>

    <?php else: ?>
        <p style="text-align:center;">Өнөөдрийн зурхай хараахан бэлэн биш байна. 🙏</p>
    <?php endif; ?>

    <div style="text-align: center; margin: 30px;">
        <a href="todayzurkhai.php" class="learn-more-button" style="display: inline-block; padding: 10px 25px; background: #e9c65e; color: #212121; text-decoration: none; border-radius: 5px; font-size: 1.2rem;">Буцах</a>
    </div>
</section>




