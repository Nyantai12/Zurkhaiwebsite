<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getZodiacSign($birthDate) {
    $zodiacSigns = [
        ['Загас', '02-19', '03-20'],    
        ['Хонь', '03-21', '04-19'],   
        ['Үхэр', '04-20', '05-20'],   
        ['Ихэр', '05-21', '06-20'],    
        ['Мэлхий', '06-21', '07-22'],  
        ['Арслан', '07-23', '08-22'],  
        ['Охин', '08-23', '09-22'],    
        ['Жинлүүр', '09-23', '10-22'], 
        ['Хилэнц', '10-23', '11-21'],  
        ['Нум', '11-22', '12-21'],     
        ['Матар', '12-22', '01-19'],
        ['Хумх', '01-20', '02-18']   
    ];
    

    $monthDay = date('m-d', strtotime($birthDate)); // Төрсөн өдрийн сар болон өдөр

    foreach ($zodiacSigns as $sign) {
        if ($monthDay >= $sign[1] && $monthDay <= $sign[2]) {
            return $sign[0]; // Ордыг буцаана
        }
    }
    return null; // Ордуудын аль нэгэнд орохгүй бол null
}



?>
