<?php

include "connect.php";

// Fetch the student's current data
if (isset($_GET["stcode"])) {
    $stcode = $_GET["stcode"];
    $result = mysqli_query($con, "SELECT * FROM students WHERE stcode=$stcode");
    $row = mysqli_fetch_assoc($result);
}

// Update the student's data
if (isset($_POST["update"])) {
    $stcode = $_POST["stcode"];
    $stlast = $_POST["stlast"];
    $stname = $_POST["stname"];
    $stgender = $_POST["stgender"];
    $stregdug = $_POST["stregdug"];
    $stemail = $_POST["stemail"];
    $stpro = $_POST["stpro"];
    $stsonirhol = isset($_POST["stsonirhol"]) ? implode(",", $_POST["stsonirhol"]) : "";


    $query = "UPDATE students SET 
                stlast=N'$stlast', 
                stname=N'$stname', 
                stgender='$stgender', 
                stregdug='$stregdug', 
                stemail='$stemail', a
                stpro='$stpro', 
                stsonirhol='$stsonirhol' 
              WHERE stcode=$stcode";
    
    if (mysqli_query($con, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Алдаа: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оюутны мэдээлэл засах</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="post">
    <label>Оюутны код:</label> <input type="text" name="stcode" value="<?php echo $row['stcode']; ?>" readonly required><br>
    <label>Овог:</label> <input type="text" name="stlast" value="<?php echo $row['stlast']; ?>" required><br>
    <label>Нэр:</label> <input type="text" name="stname" value="<?php echo $row['stname']; ?>" required><br>
    
    <label>Хүйс:</label>
    <div style="display: flex; align-items: center;margin-left: 100px">
    <label>Эрэгтэй</label>
    <input type="radio" name="stgender" value="Эрэгтэй" <?php if ($row['stgender'] == 'Эрэгтэй') echo 'checked'; ?> required>
    <label>Эмэгтэй</label>
    <input type="radio" name="stgender" value="Эмэгтэй" <?php if ($row['stgender'] == 'Эмэгтэй') echo 'checked'; ?> required><br>
    </div>
    <label>Регистр:</label> <input type="text" name="stregdug" value="<?php echo $row['stregdug']; ?>" required><br>
    <label>Цахим шуудан:</label> <input type="email" name="stemail" value="<?php echo $row['stemail']; ?>" required><br>
    <label for="stpro">Мэргэжлийн нэр:</label>
        <select name="stpro" id="stpro">
            <option value="Мэдээллийн технологи" <?php if($row["stpro"] == "Мэдээллийн технологи") echo "selected"; ?>>Мэдээллийн технологи</option>
            <option value="Дизайн" <?php if($row["stpro"] == "Дизайн") echo "selected"; ?>>Дизайн</option>
            <option value="Маркетинг" <?php if($row["stpro"] == "Маркетинг") echo "selected"; ?>>Маркетинг</option>
            <option value="Бизнесийн удирдлага" <?php if($row["stpro"] == "Бизнесийн удирдлага") echo "selected"; ?>>Бизнесийн удирдлага</option>
            <option value="Инженер" <?php if($row["stpro"] == "Инженер") echo "selected"; ?>>Инженер</option>
            <option value="Хууль" <?php if($row["stpro"] == "Хууль") echo "selected"; ?>>Хууль</option>
        </select>
        <br>

    <label>Сонирхол:</label>
    <input type="checkbox" name="stsonirhol[]" value="Сагс тоглох" <?php if (in_array('Сагс тоглох', explode(',', $row['stsonirhol']))) echo 'checked'; ?>><label>Сагс тоглох</label>
    <input type="checkbox" name="stsonirhol[]" value="Дуулах" <?php if (in_array('Дуулах', explode(',', $row['stsonirhol']))) echo 'checked'; ?>><label>Дуулах</label>
    <input type="checkbox" name="stsonirhol[]" value="Бүжиглэх" <?php if (in_array('Бүжиглэх', explode(',', $row['stsonirhol']))) echo 'checked'; ?>><label>Бүжиглэх</label><br>
    
    <button type="submit" name="update">Шинэчлэх</button>
</form>

    
</body>
</html>
