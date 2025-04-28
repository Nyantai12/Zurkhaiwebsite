<?php
include 'db.php';
include 'function.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birth = $_POST['birth_date'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Төрсөн огнооноос ордыг тодорхойлох
    $zodiac = getZodiacSign($birth);

    // Ордыг баазад хадгалах
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, zodiac_sign, birth_date) VALUES (?, ?, ?, ?, ?)");
    try {
        $stmt->execute([$name, $email, $password, $zodiac, $birth]);
        echo "✅ Бүртгэл амжилттай! <a href='login.php'>Нэвтрэх</a>";
    } catch (PDOException $e) {
        echo "⚠️ Бүртгэхэд алдаа гарлаа: " . $e->getMessage();
    }
}
?>


<form method="POST" class="register-section">
<h2>📝 Бүртгүүлэх</h2>
    Нэр: <input type="text" name="name" required placeholder="Таны нэр"><br>
    Имэйл: <input type="email" name="email" required placeholder="Таны имэйл"><br>
    Нууц үг: <input type="password" name="password" required placeholder="Нууц үгээ оруулна уу"><br>
    Төрсөн огноо: <input type="date" name="birth_date" required><br>
    <button type="submit">Бүртгүүлэх</button>
    <p><a href="login.php" class="register-link">Энд дарж нэвтэрнэ үү!!!</a></p> 
</form>

<!-- CSS -->
<style>
    /* Загварыг галактик сэдэвтэй тохируулж байгаа хэсэг */
    body {
        font-family: 'Arial', sans-serif;
        background: url('assets/images/galaxy1.jpg'); /* Галактикийн дэвсгэр зураг */
        background-size: cover;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #fff;
    }

    .register-section {
        background: rgba(0, 0, 0, 0.7); /* Харанхуй хөнгөн фон */
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .register-section h2 {
        font-size: 32px;
        margin-bottom: 20px;
        color: white; /* Алтан шар өнгө */
    }

    .register-section input[type="text"],
    .register-section input[type="email"],
    .register-section input[type="password"],
    .register-section input[type="date"] {
        width: 100%;
        padding: 12px 20px;
        margin: 10px 0;
        border-radius: 8px;
        border: 2px solid #ccc;
        background-color: #333;
        color: white;
        font-size: 16px;
        transition: 0.3s;
    }

    .register-section input[type="text"]:focus,
    .register-section input[type="email"]:focus,
    .register-section input[type="password"]:focus,
    .register-section input[type="date"]:focus {
        border-color: #e9c65e;
        background-color: #444;
        outline: none;
    }

    .register-section button {
        background-color: #574fd6; /* Хөгжмийн өнгө */
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
        transition: 0.3s;
    }

    .register-section button:hover {
        background-color: #e9c65e;
        transform: scale(1.05);
    }

    .register-section form {
        display: flex;
        flex-direction: column;
    }

    /* Үсгийн өнгийг засах */
    input::placeholder {
        color: #bbb;
    }

    /* Бүртгүүлэх линк загвар */
    .register-link {
        color: #e9c65e;
        text-decoration: none;
        font-size: 16px;
        display: block;
        margin-top: 15px;
    }

    .register-link:hover {
        text-decoration: underline;
        color: #f0d100;
    }
</style>
