<?php
include 'header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = 'zurkhaidb';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Холболт амжилтгүй боллоо: " . $conn->connect_error);
}

// Result хадгалах хувьсагч
$resultHtml = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $zodiac1 = $_POST['zodiac1'];
    $zodiac2 = $_POST['zodiac2'];

    $sql = "SELECT compatibility_text FROM compatibility WHERE (sign1 = ? AND sign2 = ?) OR (sign1 = ? AND sign2 = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $zodiac1, $zodiac2, $zodiac2, $zodiac1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $resultHtml = "
            <div class='result'>
                <div class='zodiac-images'>
                    <div class='zodiac'>
                        <img src='assets/images/{$zodiac1}.png' alt='{$zodiac1}'>
                        <p class='zodiac-name'>" . htmlspecialchars($zodiac1) . "</p>
                    </div>
                    <div class='compatibility-text'>
                        💖 " . htmlspecialchars($row['compatibility_text']) . "
                    </div>
                    <div class='zodiac'>
                        <img src='assets/images/{$zodiac2}.png' alt='{$zodiac2}'>
                        <p class='zodiac-name'>" . htmlspecialchars($zodiac2) . "</p>
                    </div>
                </div>
                <button onclick='goBack()' class='back-button'>Буцах</button>
            </div>
        ";
    }
     else {
        $resultHtml = "
            <div class='result'>
                <p>💔 Тохиромжгүй хос нийцэл байна !!!</p>
                <button onclick='goBack()' class='back-button'>Буцах</button>
            </div>
        ";
    }
}

$conn->close();
?>

<!-- CSS -->
<style>
    body {
        font-family: 'Montserrat', sans-serif;
        background: 'transparent';
        margin: 0;
        padding: 0;
    }

    .compatibility-form {
        max-width: 1700px;
        margin: 200px auto;
        padding: 30px;
        background: #ffffff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 10px;
        text-align: center;
    }

    .compatibility-form h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .compatibility-form select {
        width: 300px;
        padding: 10px;
        margin: 10px 220px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .compatibility-form button {
        width: 200px;
        padding: 10px;
        background: #e9c65e;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .compatibility-form button:hover {
        background: #574fd6;
    }
    .zodiac-name{
        font-size: 50px;
        font-weight: bold;
        color: white;
        
    }
    .result {
        max-width: 1700px;
        height:500px;
        margin: 200px ;
        padding: 30px;
        background: 'transparent';
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .zodiac-images {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 70px;
    }

    .zodiac-images img {
        width: 450px;
        height: 450px;
        object-fit: contain;
    }

    .compatibility-text {
        font-size: 30px;
        font-weight: bold;
        color: white;
        max-width: 300px;
        margin:50px;
    }

    .back-button {
        margin-top: 20px;
        padding: 10px 20px;
        background: #e9c65e;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .back-button:hover {
        background: #e53935;
    }
    /* Select элементийн стилийг өөрчлөх */
select {
    width: 100%; /* Бүтэн өргөнийг ашиглах */
    padding: 25px 60px; /* Дотоод зайг томруулж, илүү том үзэмжтэй болгоно */
    font-size: 18px; /* Фонтын хэмжээг ихэсгэж */
    background-color: #f8f8f8; /* Бага зэрэг саарал өнгө */
    border: 1px solid #ccc; /* Гаралттай хил */
    border-radius: 10px; /* Баганагийн булангуудыг дугуйрсан */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Сүүдрийг нэмнэ */
    transition: all 0.3s ease; /* Хэв маягаа зөөлөн өөрчлөх */
    outline: none; /* Сонголтын хэсгийн гадна талаас гарч буй хатуу хүрээг устгана */
}

/* Hover үед */
select:hover {
    border-color: #e9c65e; /* Сарнай шар өнгө */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Сүүдэр ихэсгэх */
}

/* Focus үед */
select:focus {
    border-color: #574fd6; /* Фокус хийхэд өнгө өөрчлөгдөнө */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Focus үед сүүдэр нэмэгдэнэ */
}

select option {
    height:40px;
    padding: 10px 60px; /* Дотоод зай нэмнэ */
    font-size: 16px; /* Фонтын хэмжээ */
    background-color: #fff; /* Цагаан фон */
    color: #333; /* Хар өнгөтэй текст */
}

/* Сонгогдсон option дээр hover хийж буй үед */
select option:hover {
    background-color: #e9c65e; /* Сарнай шар өнгө */
    color: #fff; /* Цагаан өнгийн текст */
}

</style>

<!-- HTML -->
<div class="compatibility-form" id="formContainer" <?php if (!empty($resultHtml)) echo 'style="display:none;"'; ?>>
    <h2>Хос нийцэл шалгах</h2>
    <form method="POST">
        <select name="zodiac1" required>
        <option value="">Ордын 1 сонгох</option>
        <option value="Хонь">♈ Хонь (Aries)</option>
        <option value="Үхэр">♉ Үхэр (Taurus)</option>
        <option value="Ихэр">♊ Ихэр (Gemini)</option>
        <option value="Мэлхий">♋ Мэлхий (Cancer)</option>
        <option value="Арслан">♌ Арслан (Leo)</option>
        <option value="Охин">♍ Охин (Virgo)</option>
        <option value="Жинлүүр">♎ Жинлүүр (Libra)</option>
        <option value="Хилэнц">♏ Хилэнц (Scorpio)</option>
        <option value="Нум">♐ Нум (Sagittarius)</option>
        <option value="Матар">♑ Матар (Capricorn)</option>
        <option value="Хумх">♒ Хумх (Aquarius)</option>
        <option value="Загас">♓ Загас (Pisces)</option>
    </select>


    <select name="zodiac2" required>
        <option value="">Ордын 2 сонгох</option>
        <option value="Хонь">♈ Хонь (Aries)</option>
        <option value="Үхэр">♉ Үхэр (Taurus)</option>
        <option value="Ихэр">♊ Ихэр (Gemini)</option>
        <option value="Мэлхий">♋ Мэлхий (Cancer)</option>
        <option value="Арслан">♌ Арслан (Leo)</option>
        <option value="Охин">♍ Охин (Virgo)</option>
        <option value="Жинлүүр">♎ Жинлүүр (Libra)</option>
        <option value="Хилэнц">♏ Хилэнц (Scorpio)</option>
        <option value="Нум">♐ Нум (Sagittarius)</option>
        <option value="Матар">♑ Матар (Capricorn)</option>
        <option value="Хумх">♒ Хумх (Aquarius)</option>
        <option value="Загас">♓ Загас (Pisces)</option>
    </select>


<button type="submit" style="
  -webkit-text-stroke: 0.5px black;
  color: black;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  font-size: 16px;
">
  Шалгах
</button>


    </form>
</div>

<!-- Харуулах үр дүн -->
<?php
if (!empty($resultHtml)) {
    echo $resultHtml;
}
?>

<!-- JavaScript -->
<script>
    function goBack() {
        document.getElementById('formContainer').style.display = 'block'; // Форм буцааж гаргах
        document.querySelector('.result').style.display = 'none'; // Резулт устгах
    }
</script>

<?php
include 'footer.php';
?>
