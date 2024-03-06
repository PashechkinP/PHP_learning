<?php

if (isset($_POST['field'])) {

    echo $_POST['field'][0] . "<br>";
    echo $_POST['field'][2];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <!-- <style type="text/css" media="all">
@import url("styles.css");
</style> -->

</head>

<body>
    <form action="moveFunc.php" method="post">
        <div style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;display: flex;flex-wrap: wrap;align-items: center;justify-content: center;">
            <table border="2" style="border-collapse:collapse; width:17%; text-align:center">
                <?php
                session_start();
                if (isset($_POST["field"])) {
                    $_SESSION["gameField"][$_POST['field'][0]][$_POST['field'][2]] = "X";
                }
                $krestiki = $_SESSION["gameField"];
                $krestiki =randAiMove($krestiki);
                renderField($krestiki);

                // checkWin($krestiki);
                $_SESSION["gameField"] = $krestiki;

                ?>
            </table>
            <input style="font-size: 30px; margin-left:20px; margin-top:273px" type="submit" name="action" value="Поставить крестик" />
        </div>
    </form>
</body>

</html>


<?php
function randAiMove($krestiki)
{
    $x = rand(0, 2);
    $y = rand(0, 2);
    while ($krestiki[$x][$y] != "") {
        $x = rand(0, 2);
        $y = rand(0, 2);
    }
    $krestiki[$x][$y]="O";
    return $krestiki;
}
?>


<?php
function renderField($krestiki)
{
    $result = checkWin($krestiki);
    if ($result){
        if($result == 1) {
            for ($i = 0; $i < 3; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 3; $j++) {
                    
                        if ($i==$j) {
                            echo  '<td style="font-size:90px;background-color:green">' . $krestiki[$i][$j] . '</td>';
                        }
                        else {
                            echo  '<td style="font-size:90px">' . $krestiki[$i][$j] . '</td>';
                        }

                    }
                }
                    echo "</tr>";
            
        }
        if($result == 2) {
            for ($i = 0; $i < 3; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 3; $j++) {
                    
                        if ($i + $j == 2) {
                            echo  '<td style="font-size:90px;background-color:green">' . $krestiki[$i][$j] . '</td>';
                        }
                        else {
                            echo  '<td style="font-size:90px">' . $krestiki[$i][$j] . '</td>';
                        }

                    }
                }
                    echo "</tr>";
        }
        if($result == 3) {
            for ($i = 0; $i < 3; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 3; $j++) {
                    
                        if ($krestiki[$i][0] == $krestiki[$i][1] && $krestiki[$i][1] == $krestiki[$i][2] && $krestiki[$i][0] == "X") 
                        {
                            echo  '<td style="font-size:90px;background-color:green">' . $krestiki[$i][$j] . '</td>';
                        }
                        else {
                            echo  '<td style="font-size:90px">' . $krestiki[$i][$j] . '</td>';
                        }

                    }
                }
                    echo "</tr>";
        }
    } else {
        for ($i = 0; $i < 3; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 3; $j++) {
                if ($krestiki[$i][$j] == "") {
                    echo '<td style="font-size:90px"><input type="radio" name="field" value="' . "$i-$j" . '" style="height:70px; width:70px; vertical-align: middle; margin: 15px" /></td>';
                } else {
                    echo  '<td style="font-size:90px">' . $krestiki[$i][$j] . '</td>';
                }
            }
    
            echo "</tr>";
        }
    }

    
}

?>


<?php
function checkWin($krestiki)
{
    $winLoose=0;

    if ($krestiki[0][0] == $krestiki[1][1] && $krestiki[1][1] == $krestiki[2][2] && $krestiki[2][2] != "") {
        $winLoose=1;
        echo " YOU ARE THE WINNER ! ! !";
        return $winLoose;
        // session_destroy();
    }

    if ($krestiki[2][0] == $krestiki[1][1] && $krestiki[1][1] == $krestiki[0][2] && $krestiki[0][2] != "") {
        $winLoose=2;
        echo " YOU ARE THE WINNER ! ! !";
        return  $winLoose;
        // session_destroy();
    }

    for ($i = 0; $i < 3; $i++) {


            if ($krestiki[$i][0] == $krestiki[$i][1] && $krestiki[$i][1] == $krestiki[$i][2] && $krestiki[$i][0] != "") {
                $winLoose=3;
                echo " YOU ARE THE WINNER ! ! !";
                return  $winLoose;
            }

            if ($krestiki[0][$i] == $krestiki[1][$i] && $krestiki[1][$i] == $krestiki[2][$i] && $krestiki[0][$i] != "") {
                $winLoose=4;
                echo " YOU ARE THE WINNER ! ! !";
                return  $winLoose;
        }
    }
    return $winLoose;
}
?>

<?php
function aiMove($krestiki)
{
    $diagCount1 = 0;
    $diagCount2 = 0;
    $rowsCount = 0;
    $colCount = 0;
    $iCoordFor0Field = 0;
    $jCoordFor0Field = 0;

    for ($i = 0; $i < 3; $i++) {

        for ($j = 0; $j < 3; $j++) {
            if ($krestiki[$i][$j] != "" && $i == $j) {  // проверка главной диагонали на наличие двух Х
                $diagCount1++;
                if ($krestiki[$i][$j] == "") {
                    $iCoordFor0Field = $i;
                    $jCoordFor0Field = $j;
                }
                if ($diagCount1 == 2) {
                    $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
                    break;
                }
            } else if ($krestiki[$i][$j] == "X" && $i + $j == 2) {   // проверка побочной диагонали на наличие двух Х
                $diagCount2++;
                if ($krestiki[$i][$j] == "") {
                    $iCoordFor0Field = $i;
                    $jCoordFor0Field = $j;
                }
                if ($diagCount2 == 2) {
                    $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
                    break;
                }
            } else if ($krestiki[0][$j] == "X") {   // проверка рядов на наличие двух Х
                $rowsCount++;
                if ($krestiki[$i][$j] == "") {
                    $iCoordFor0Field = $i;
                    $jCoordFor0Field = $j;
                }
                if ($rowsCount == 2) {
                    $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
                }
            } else if ($krestiki[1][$j] == "X") {   // проверка рядов на наличие двух Х
                $rowsCount++;
                if ($krestiki[$i][$j] == "") {
                    $iCoordFor0Field = $i;
                    $jCoordFor0Field = $j;
                }
                if ($rowsCount == 2) {
                    $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
                }
            } else if ($krestiki[2][$j] == "X") {   // проверка рядов на наличие двух Х
                $rowsCount++;
                if ($krestiki[$i][$j] == "") {
                    $iCoordFor0Field = $i;
                    $jCoordFor0Field = $j;
                }
                if ($rowsCount == 2) {
                    $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
                }
            } else if ($krestiki[$i][0] == "X") {   // проверка столбцов на наличие двух Х
                $colCount++;
                if ($krestiki[$i][$j] == "") {
                    $iCoordFor0Field = $i;
                    $jCoordFor0Field = $j;
                }
                if ($rowsCount == 2) {
                    $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
                }
            } else if ($krestiki[$i][1] == "X") {   // проверка столбцов на наличие двух Х
                $colCount++;
                if ($krestiki[$i][$j] == "") {
                    $iCoordFor0Field = $i;
                    $jCoordFor0Field = $j;
                }
                if ($rowsCount == 2) {
                    $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
                }
            } else if ($krestiki[$i][2] == "X") {   // проверка столбцов на наличие двух Х
                $colCount++;
                if ($krestiki[$i][$j] == "") {
                    $iCoordFor0Field = $i;
                    $jCoordFor0Field = $j;
                }
                if ($rowsCount == 2) {
                    $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
                }
            }


            //    else {                               // если нет нигде двух Х, то в первое пустое место
            //     $krestiki[$iCoordFor0Field][$jCoordFor0Field] = "O";
            //  }


        }
    }
    $diagCount1 = 0;
    $diagCount2 = 0;
    $rowsCount = 0;
    $colCount = 0;
    $iCoordFor0Field = 0;
    $jCoordFor0Field = 0;
    return $krestiki;
}
?>