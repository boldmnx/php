<?php
$name = "BOLD"; // Бүтэн нэр

$pattern = [
    "B" => ["**  ", "* * ", "**  ", "* * ", "**  "],
    "O" => [" ** ", "*  *", "*  *", "*  *", " ** "],
    "L" => ["*   ", "*   ", "*   ", "*   ", "****"],
    "D" => ["**  ", "* * ", "*  *", "* * ", "**  "],
    "E" => ["****", "*   ", "*** ", "*   ", "****"],
    "R" => ["**  ", "* * ", "*** ", "* * ", "*  *"],
    "N" => ["*   ", "*  *", "*   *", "*  *", "*   *"],
];

echo "<pre>";
for ($i = 0; $i < 5; $i++) { // 5 мөртэй үсэгнүүд
    foreach (str_split($name) as $letter) { // Нэрийн бүх үсгийг давтах
        $letter = strtoupper($letter); // Үсгийг том болгох
        echo $pattern[$letter][$i] . "   "; // Үсэг бүрийн схемийг хэвлэх
    }
    echo "<br>"; // Мөр шилжүүлэх
}
echo "</pre>";


// Төгс тоог шалгах функц
function isPerfectNumber($number) {
    $sum = 0;
    for ($i = 1; $i <= $number / 2; $i++) {
        if ($number % $i == 0) {
            $sum += $i;
        }
    }
    return $sum == $number;
}

// 1-1000 хүртэлх бүх тоог шалгаж төгс тоонуудыг хэвлэх
for ($i = 1; $i <= 1000; $i++) {
    if (isPerfectNumber($i)) {
        // Төгс тоонуудыг тод өнгөөр хэвлэх
        echo "<span style='color: red;'>$i</span>.<br>";
    }
}




//-----------------------------------

// Холболтын тохиргоо
$hostname = 'localhost';  // Серверийн нэр
$user = 'pma';            // Хэрэглэгчийн нэр
$pass = '';               // Нууц үг
$database = 'lab5';       // Өгөгдлийн сангийн нэр

// Холболт үүсгэх
$con2 = mysqli_connect($hostname, $user, $pass, $database);

// Холболт амжилттай бол "Connected successfully" гэсэн мессеж хэвлэх
if (!$con2) {
    // Холболтын алдааг харуулах
    die('Холболт амжилтгүй: ' . mysqli_connect_error());
} else {
    echo 'Connected successfully host<br>';  // Сервертэй холбогдсон
    echo 'Connected successfully database<br>';  // Өгөгдлийн сан холбогдсон
}

// Холболтыг хаах
mysqli_close($con2);
?>


?>
