<?php
include "connect.php";

// Өгөгдөл нэмэх
if (isset($_POST["insert"])) {
    $stcode = mysqli_real_escape_string($con, $_POST["stcode"]);
    $stlast = mysqli_real_escape_string($con, $_POST["stlast"]);
    $stname = mysqli_real_escape_string($con, $_POST["stname"]);
    $stgender = mysqli_real_escape_string($con, $_POST["stgender"]);
    $stregdug = mysqli_real_escape_string($con, $_POST["stregdug"]);
    $stemail = mysqli_real_escape_string($con, $_POST["stemail"]);
    $stpro = mysqli_real_escape_string($con, $_POST["stpro"]);

    // Checkbox-уудыг нэгтгэж хадгалах
    $stsonirhol = isset($_POST["stsonirhol"]) ? implode(", ", $_POST["stsonirhol"]) : "";

    $query = "INSERT INTO students (stcode, stlast, stname, stgender, stregdug, stemail, stpro, stsonirhol) 
              VALUES ('$stcode', N'$stlast', N'$stname', '$stgender', '$stregdug', '$stemail', '$stpro', '$stsonirhol')";

    if (mysqli_query($con, $query)) {
        echo "<p style='color:green;'>Амжилттай нэмэгдлээ!</p>";
    } else {
        echo "<p style='color:red;'>Алдаа: " . mysqli_error($con) . "</p>";
    }
}


// Оюутны мэдээлэл дуудах
$results = mysqli_query($con, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Оюутны бүртгэл</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <h2>Оюутан бүртгэх</h2>
    <form action="" method="post">
        <label>Оюутны код:</label> <input type="text" name="stcode" required><br>
        <label>Овог:</label> <input type="text" name="stlast" required><br>
        <label>Нэр:</label> <input type="text" name="stname" required><br>      
        <label>Хүйс:</label>
        <div style="display: flex; align-items: center;margin-left: 100px">
        <label>Эрэгтэй</label>
            <input type="radio" name="stgender" value="Эрэгтэй" required>
            <label>Эмэгтэй</label>
            <input type="radio" name="stgender" value="Эмэгтэй" required>
            
        </div>
        <label>Регистр:</label> <input type="text" name="stregdug" required><br>
        <label>Email:</label> <input type="email" name="stemail" required><br>
        <label for="stpro">Мэргэжлийн нэр:</label> 
        <select name="stpro" id="stpro">
            <option value="">-----</option>
            <option value="Мэдээллийн технологи">Мэдээллийн технологи</option>
            <option value="Дизайн">Дизайн</option>
            <option value="Маркетинг">Маркетинг</option>
            <option value="Бизнесийн удирдлага">Бизнесийн удирдлага</option>
            <option value="Инженер">Инженер</option>
            <option value="Хууль">Хууль</option>
        </select>
        <br>
        <label>Сонирхол:</label>
        <input type="checkbox" name="stsonirhol[]" value="Сагс тоглох" ><label>Сагс тоглох</label>
        <input type="checkbox" name="stsonirhol[]" value="Дуулах" ><label>Дуулах</label>
        <input type="checkbox" name="stsonirhol[]" value="Бүжиглэх" ><label>Бүжиглэх</label><br>

        <button type="submit" name="insert">Нэмэх</button>
    </form>

    <h2>Бүртгэлтэй оюутнууд</h2>
    <table border="1">
        <tr>
            <th>Оюутны код</th>
            <th>Овог</th>
            <th>Нэр</th>
            <th>Хүйс</th>
            <th>Регистр</th>
            <th>Цахим шуудан</th>
            <th>Мэргэжлийн нэр</th>
            <th>Сонирхол</th>
            <th>Үйлдэл</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($results)) { ?>
        <tr>
            <td><?php echo $row["stcode"]; ?></td>
            <td><?php echo $row["stlast"]; ?></td>
            <td><?php echo $row["stname"]; ?></td>
            <td><?php echo $row["stgender"]; ?></td>
            <td><?php echo $row["stregdug"]; ?></td>
            <td><?php echo $row["stemail"]; ?></td>
            <td><?php echo $row["stpro"]; ?></td>
            <td><?php echo $row["stsonirhol"]; ?></td>
            <td>
            <a href="update.php?stcode=<?php echo $row["stcode"]; ?>">
                <i class="fa-solid fa-pen-to-square"></i>
            </a> |
            <a href="delete.php?stcode=<?php echo $row["stcode"]; ?>" onclick="return confirm('Устгах уу?');">
                <i class="fa-solid fa-trash"></i>
            </a>

            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
