<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");  
    exit;
}

// Нэвтрэх процесс буюу код
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['zodiac_sign'] = $user['zodiac_sign'];
        header("Location: index.php");  
        exit;
    } else {
        echo "⚠️ Нууц үг эсвэл имэйл буруу байна!";
    }
}
?>

<section class="login-section">
    <h2>Нэвтрэх</h2>
    <form method="POST">
        Имэйл: <input type="email" name="email" required><br>
        Нууц үг: <input type="password" name="password" required><br>
        <button type="submit">Нэвтрэх</button>
    </form>
    <p><a href="register.php" class="register-link">Энд дарж бүртгүүлнэ</a></p> <!-- Бүртгүүлэх линк -->
</section>

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

    .login-section {
        background: rgba(0, 0, 0, 0.7); /* Харанхуй хөнгөн фон */
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .login-section h2 {
        font-size: 32px;
        margin-bottom: 20px;
        color: white; /* Алтан шар өнгө */
    }

    .login-section input[type="email"],
    .login-section input[type="password"] {
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

    .login-section input[type="email"]:focus,
    .login-section input[type="password"]:focus {
        border-color: #e9c65e;
        background-color: #444;
        outline: none;
    }

    .login-section button {
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

    .login-section button:hover {
        background-color: #e9c65e;
        transform: scale(1.05);
    }

    .login-section form {
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
