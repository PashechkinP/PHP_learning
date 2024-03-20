<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />


</head>

<body>
    <div style="display: inline-flex;justify-content: space-between;">
        <?php

        $path = getcwd();

        if (is_dir($path)) {

            if ($dh = opendir($path)) {

                while (($file = readdir($dh)) !== false) {

                    if ($file == '.' || $file == '..') continue;

                    if (!is_dir($file)) {
                        $pngPages = "page";

                        if (str_contains($file, $pngPages)) {
                           
                            echo "<img style='width:500px;height:600px;border:2px solid black' src='$file' />";
                            echo "<br>";
                        }
                        
                        echo "<br>";
                    }
                }

                closedir($dh);
                echo "<br>";
            }
        }
        ?>
    </div>
</body>

</html>