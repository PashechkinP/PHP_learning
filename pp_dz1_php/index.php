<!DOCTYPE html>
<html>

<head>
    <title>METANIT.COM</title>
    <meta charset="utf-8" />
</head>

<body>
    <?php
    $name = "";
    $age = "";
    $ahui ="";
    if (isset($_POST["name"])) {

        $name = $_POST["name"];
    }
    if (isset($_POST["age"])) {

        $age = $_POST["age"];
    }
    if (isset($_POST["ahui"])) {

        $ahui = $_POST["ahui"];
    }
    session_start();
    
    $_SESSION["ebal"][]=array('name'=>$name,'age'=>$age, 'ahui'=>$ahui);
    
    foreach($_SESSION["ebal"] as $suka){
        
        foreach ($suka as $key => $value){
            echo "$key => $value <br>";
        }
        echo"<br>";
    }
    ?>
    <h3>Форма ввода данных</h3>
    <form method="POST">
        <p>Имя: <input type="text" name="name" /></p>
        <p>Возраст: <input type="text" name="age" /></p>
        <p>Ohuevaemost: <input type="text" name="ahui" /></p>
        <input type="submit" value="Отправить">
    </form>
</body>

</html>