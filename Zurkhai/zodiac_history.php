<?php
// header.php хуудас гэх мэт зүйлийг хэрэггүй гэж үзвэл шууд энд бичиж болно.
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зурхайн Түүх & Домог</title>
    <style>
        /* Basic styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #4caf50;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        header nav ul li {
            display: inline;
            margin: 0 15px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        h1 {
            margin: 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px 0;
        }

        .section {
            padding: 40px 0;
            background-color: #fff;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            color: #4caf50;
        }

        .zodiac-card {
            background-color: #f9f9f9;
            margin: 20px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <div class="container">
        <h1>Зурхайн Түүх & Домог</h1>
        <nav>
            <ul>
                <li><a href="#intro">Танилцуулга</a></li>
                <li><a href="#origin">Зурхайн Гарал Үүсэл</a></li>
                <li><a href="#history">Ордуудын Түүх ба Домог</a></li>
                <li><a href="#influence">Зурхайн Нөлөө</a></li>
                <li><a href="#global">Глобал Нөлөө</a></li>
                <li><a href="#health">Биеийн Эрүүл Мэнд</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Content -->
<main>
    <section id="intro" class="section">
        <div class="container">
            <h2>Танилцуулга</h2>
            <p>Зурхай нь олон мянган жилийн өмнө бүхий л соёл иргэншилд хувь тавиланг тодорхойлох үндсэн ойлголт байжээ. Эртний хүмүүс оддыг судалж, тэдний хөдөлгөөнөөс амьдралын чиг хандлага болон хувь тавиланг тодорхойлохыг зорьдог байсан. Зурхай нь тэнгэрийн од, нар, сар болон бүтэн ордуудыг судалдаг.</p>
        </div>
    </section>

    <section id="origin" class="section">
        <div class="container">
            <h2>Зурхайн Гарал Үүсэл</h2>
            <p>Зурхай нь эртний Месопотамид үүссэн бөгөөд тэнгэрийн оддыг ажиглах замаар амьдралтайгаа холбосон соёлд чухал үүрэг гүйцэтгэж байжээ. Эртний Египет, Грек, Ром болон Энэтхэг зэрэг улс орнуудад зурхайн ойлголт хөгжиж, зурхайн түүх нь олон арван жилийн туршид хувьсан өөрчлөгдсөн.</p>
        </div>
    </section>

    <section id="history" class="section">
        <div class="container">
            <h2>Ордуудын Түүх ба Домог</h2>
            <div class="zodiac-card">
                <h3>Хонь Ордын Түүх</h3>
                <p>Эртний Грек болон Ромын домогт Хонь орд нь хайр, хүч чадал, өөдрөг үзлийг илэрхийлдэг байсан.</p>
            </div>
            <div class="zodiac-card">
                <h3>Үхэр Ордын Түүх</h3>
                <p>Египетийн болон Грек домогт Үхэр орд нь тогтвортой байдал, хүч чадлын бэлгэдэл болж байжээ.</p>
            </div>
            <div class="zodiac-card">
                <h3>Ихэр Ордын Түүх</h3>
                <p>Домогт Ихэр ордыг Хийн болон Логос гэсэн хоёр бурханы дүрээр харуулсан байдаг.</p>
            </div>
            <!-- Бусад ордуудын мэдээллийг энд оруулна -->
        </div>
    </section>

    <section id="influence" class="section">
        <div class="container">
            <h2>Зурхай дахь Түүхэн Үзэл Баримтлал ба Нөлөө</h2>
            <p>Зурхайн ордууд нь өөр өөр соёлд хэрхэн нөлөөлж байсан талаар тайлбарлана. Зарим ордууд нь соёлын өөрчлөлтөд чухал үүрэг гүйцэтгэж байсан бол зарим нь хувь хүний амьдралын шийдвэрүүдэд ч нөлөөлжээ.</p>
        </div>
    </section>

    <section id="global" class="section">
        <div class="container">
            <h2>Зурхайн Глобал Нөлөө</h2>
            <p>Зурхай нь дэлхий даяар танигдсан бөгөөд ордуудын ойлголт нь бүхий л соёлд янз бүрийн хэлбэрээр хэрэгжиж ирсэн. Орд бүрийн глобал нөлөө, олон соёлд хэрхэн шингэсэн нь сонирхолтой байж болох юм.</p>
        </div>
    </section>

    <section id="health" class="section">
        <div class="container">
            <h2>Зурхай болон Биеийн Эрүүл Мэнд</h2>
            <p>Зурхайн ордууд нь хүмүүсийн амьдралын хэв маяг, сэтгэл зүй болон биеийн эрүүл мэндэд хэрхэн нөлөөлж байгааг тайлбарлах зорилготой. Ордууд нь өөрийн шинж чанараараа хүмүүстэй харьцангуй өөр өөр нөлөө үзүүлдэг.</p>
        </div>
    </section>
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2025 Зурхайн Түүх & Домог</p>
    </div>
</footer>

</body>
</html>
