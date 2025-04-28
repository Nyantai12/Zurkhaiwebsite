<?php
include 'header.php';
// Session болон хэрэглэгч шалгах хэсэг
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Зурхай мэдээлэл авах
include 'db.php';
$zodiac = $_SESSION['zodiac_sign'];
$today = date('Y-m-d');

$stmt = $pdo->prepare("SELECT daily_horoscope FROM horoscopes WHERE zodiac_sign = ? AND date = ?");
$stmt->execute([$zodiac, $today]);
$data = $stmt->fetch();
?>
<section id="today-zurkhai" class="today-zurkhai-section">
    <h2 style="margin-top: 50px;">Өнөөдрийн Зурхай</h2>
    <div class="section-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 50px; padding: 40px;">
        <!-- Зурхайн текст хэсэг -->
        <div class="section-content1" style="flex: 1; text-align: center; margin-top:-150px">
            <h1><?php echo htmlspecialchars($zodiac); ?></h1>
            <?php if ($data): ?>
                <p style="margin-top: 20px; font-size:18px">Таны өнөөдрийн зурхай:</p>
                <p style="font-size:30px;font-weight:bold">"<?php echo nl2br(htmlspecialchars($data['daily_horoscope'])); ?>"</p>
            <?php else: ?>
                <p style="margin-top: 0px;">Өнөөдрийн зурхай бэлэн биш байна. Түр хүлээгээрэй! 🙏</p>
            <?php endif; ?>
        </div>

        <!-- Зураг харуулах хэсэг -->
        <div class="section-image" style="flex: 1; text-align: center; margin-top:-50px">
            <img src="assets/images/zodiac.png" alt="Зурхайн зураг" class="rotate-image" style="max-width: 450px; width: 100%; height: auto; border-radius: 15px;">
        </div>

    </div>
    <a href="othertodayzurkhai.php" class="learn-more-button" style="    display: inline-block;
    margin-top:5px;
    padding: 8px 20px;
    background: #e9c65e;
    color: #212121;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.1rem;
    transition: background-color 0.3s ease;">Бусад ордын өнөөдрийн зурхайг харах</a>
</section>




<?php
include 'footer.php';
?>
