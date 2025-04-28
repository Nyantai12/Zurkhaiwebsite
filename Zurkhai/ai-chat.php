<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

echo "<h2>🗣️ AI Зурхайчтай чат</h2>";
echo "<p>Таны орд: " . htmlspecialchars($_SESSION['zodiac_sign']) . "</p>";
?>

<div id="chat-box">
    <div id="chat-messages"></div>
</div>

<form id="chat-form">
    <input type="text" id="user-message" placeholder="Тантай зурхайч ярилцана..." required>
    <button type="submit">Илгээх</button>
</form>

<script>
document.getElementById('chat-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let userMessage = document.getElementById('user-message').value;
    
    // Хэрэглэгчийн мессежийг чатанд нэмэх
    let chatMessages = document.getElementById('chat-messages');
    let userMessageDiv = document.createElement('div');
    userMessageDiv.classList.add('user-message');
    userMessageDiv.textContent = 'Таны асуулт: ' + userMessage;
    chatMessages.appendChild(userMessageDiv);

    // Хариулт оруулах (AI зурхайчийн хариу)
    let aiMessageDiv = document.createElement('div');
    aiMessageDiv.classList.add('ai-message');
    aiMessageDiv.textContent = 'AI Зурхайч: ' + getAIResponse(userMessage); // AI хариултыг авах функц
    chatMessages.appendChild(aiMessageDiv);
    
    document.getElementById('user-message').value = ''; // Хэрэглэгчийн мессежийг цэвэрлэх
    chatMessages.scrollTop = chatMessages.scrollHeight; // Сүүлд нэмэгдсэн мессеж рүү шилжих
});

function getAIResponse(message) {
    // Энэ нь ашиглагдаж буй AI системийн хариулт өгнө. Жишээ нь:
    if (message.toLowerCase().includes("ордын шинжилгээ")) {
        return 'Таны ордны шинжилгээ бол …';
    } else {
        return 'Таны асуултанд хариулт олдсонгүй.';
    }
}
</script>

