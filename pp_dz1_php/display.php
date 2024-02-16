<?php
$name = $_POST["firstname"];
$surname = $_POST["lastname"];
$xArr = $_POST["xArray"];
$yArr = $_POST["yArray"];
$fontSize = 40;
$nameSize = strlen($name);
$surnameSize = strlen($surname);
$redNum = 255;
$greenNum = 0;
$blueNum = 255;

for($i = 0; $i < $nameSize; $i++){

    echo '<span style="font-size: '.$fontSize.' ">' . $name[$i] . '</span>';
    $fontSize += 3;
}
echo "<br>";

// лучше задавать рандомные значения от 0 до 255
for($i = 0; $i < $surnameSize; $i++){

    echo '<span style="color: rgb('.$redNum.','.$greenNum.','.$blueNum.'); font-size: 40">' . $surname[$i] . '</span>' ;
    $redNum -= 25;
    $greenNum += 30;
    $blueNum -= 25;  
}
echo "<br>";

for ($i = 0; $i < $xArr; $i++){
    for($j = 0; $j < $yArr; $j++){
        echo "<span>*</span>";
    }
    echo "<br>";
}

?>