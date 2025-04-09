<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>RGB Өнгө Сонгох</title>
    <style>
        .color-box {
            width: 100px;
            height: 100px;
            margin-top: 20px;
        }
        .text {
            font-weight: bold;
            color: blue;
        }
    </style>
</head>
<body><a href="http://localhost/osan/lab6/post_method.php">got to postMethod</a><br>


    <form action="" method="post">
        <label for="r">R:</label>
        <input type="number" id="r" name="r" min="0" max="255" required><br>

        <label for="g">G:</label>
        <input type="number" id="g" name="g" min="0" max="255" required><br>

        <label for="b">B:</label>
        <input type="number" id="b" name="b" min="0" max="255" required><br>

        <button type="submit">Show me</button>
    </form>

    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $r = intval($_POST['r']);
        $g = intval($_POST['g']);
        $b = intval($_POST['b']);

        // RGB өнгөний кодыг шалгах (0-255 хооронд байх ёстой)
        if ($r >= 0 && $r <= 255 && $g >= 0 && $g <= 255 && $b >= 0 && $b <= 255) {
            $color = "rgb($r, $g, $b)";
            echo "<p class='text'>R: <span style='color:red;'>$r</span></p>";
            echo "<p class='text'>G: <span style='color:green;'>$g</span></p>";
            echo "<p class='text'>B: <span style='color:blue;'>$b</span></p>";
            echo "<div class='color-box' style='background-color:$color;'></div>";
        } else {
            echo "<p style='color:red;'>RGB утгууд 0-255 хооронд байх ёстой!</p>";
        }
    }
    ?>

</body>
</html>
