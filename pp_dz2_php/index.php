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

                $krestiki = [["", "", ""], ["", "", ""], ["", "", ""]];

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
                ?>
            </table>
            <input style="font-size: 30px; margin-left:20px; margin-top:305px" type="submit" name="action" value="Поставить крестик" />
        </div>
    </form>
</body>

</html>
