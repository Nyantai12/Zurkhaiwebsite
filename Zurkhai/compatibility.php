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
<style>

    .compatibility-form {
        max-width: 1000px;
        margin: 180px auto;
        
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
        width: 80%;
        padding: 15px;
        margin: 15px auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: block;
    }

    .compatibility-form button {
        width: 60%;
        padding: 12px;
        background: #e9c65e;
        color: black;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 20px;
    }

    .compatibility-form button:hover {
        background: #574fd6;
        color: white;
    }

    .zodiac-name {
        font-size: 30px;
        font-weight: bold;
        color: white;
        margin-top: 10px;
    }

    .result {
        max-width: 2500px;
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
    width: 950px;
    font-size: 25px;
    font-weight: bold;
    color: white;
    max-width: 1000px;
    margin: 50px auto;
    white-space: normal; /* Allow the text to wrap */
    word-wrap: break-word; /* Ensures long words break if necessary */
    overflow-wrap: break-word; /* Prevents overflow of long words */
    line-height: 1.6; /* Improves readability */
    text-align: center; /* Center-aligns the text */
    padding: 20px; /* Adds some padding for better spacing */
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

    select {
        padding: 15px 20px;
        font-size: 16px;
        border-radius: 10px;
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        outline: none;
    }

    select:hover {
        border-color: #e9c65e;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    select:focus {
        border-color: #574fd6;
    }

    select option {
        padding: 10px 20px;
        font-size: 16px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .zodiac-images {
            flex-direction: column;
            gap: 20px;
        }

        .zodiac-images img {
            width: 200px;
            height: 200px;
        }

        .compatibility-text {
        font-size: 20px; /* Smaller font size for medium screens */
        padding: 15px; /* Reduce padding for smaller screens */
        margin: 30px auto; /* Adjust margin for better spacing */
    }

        .compatibility-form select {
            width: 90%;
        }

        .compatibility-form button {
            width: 80%;
        }
    }

    @media (max-width: 600px) {
        .compatibility-form {
            padding: 20px;
            margin: 100px auto;
        }

        .zodiac-images img {
            width: 150px;
            height: 150px;
        }

        .zodiac-name {
            font-size: 24px;
        }

        .compatibility-text {
        font-size: 20px; /* Smaller font size for medium screens */
        padding: 15px; /* Reduce padding for smaller screens */
        margin: 30px auto; /* Adjust margin for better spacing */
    }
        .compatibility-form button {
            width: 100%;
        }

        .result {
            padding: 20px;
            margin: 100px auto;
        }
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

