<?php
abstract class Literature
{

    function __construct(protected $author, protected $name, protected $pages, protected $year, protected $cover)
    {
        $this->author = $author;
        $this->name = $name;
        $this->pages = $pages;
        $this->year = $year;
        $this->cover = $cover;
    }

    function ShowInfo()
    {
        echo $this->author . $this->name . $this->pages . $this->year . $this->cover;
    }
}

class TextLiterature extends Literature
{
}

class ImgLiterature extends Literature
{
}


//====================================================================================================

class FunFiction extends TextLiterature
{

    function __construct($author, $name, $pages, $year, $cover, protected $source)
    {
        $this->author = $author;
        $this->name = $name;
        $this->pages = $pages;
        $this->year = $year;
        $this->cover = $cover;
        $this->source = $source;
    }

    function ShowInfo()
    {
        return parent::ShowInfo().$this->source;
    }
}

class Book extends TextLiterature
{

    function __construct($author, $name, $pages, $year, $cover)
    {
        $this->author = $author;
        $this->name = $name;
        $this->pages = $pages;
        $this->year = $year;
        $this->cover = $cover;
    }

    function ShowInfo()
    {
        return parent::ShowInfo();
    }
}

class Comics extends ImgLiterature
{

    function __construct($author, $name, $pages, $year, $cover, protected $artist, protected $colour)
    {
        $this->author = $author;
        $this->name = $name;
        $this->pages = $pages;
        $this->year = $year;
        $this->cover = $cover;
        $this->artist = $artist;
        $this->colour = $colour;
    }

    function ShowInfo()
    {
        return parent::ShowInfo().$this->artist.$this->colour;
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />


</head>

<body>

    <?php

    $path = getcwd();

    if (is_dir($path)) {
        if ($dh = opendir($path)) {
            while (($folder = readdir($dh)) !== false) {
                if ($folder == '.' || $folder == '..') continue;
                if (is_dir($folder)) {
                    echo "каталог: $folder <br>";

                    if($dx = opendir($folder)){
                        while (($file = readdir($dx)) !== false){
                            if ($file == '.' || $file == '..') continue;
                            if (!is_dir($file)){
                                $pngExt =".png";
                                $metaTxt ="meta.txt";
                                if(str_contains($file,$pngExt)){
                                    echo "<img style='width:200px;height:300px' src='$folder/$file' />";
                                    echo "<br>";
                                    
                                }
                                
                                echo "файл:    $file <br>";


                                if (str_contains($file, $metaTxt)) {
                                    $metachka = file_get_contents(__DIR__ . '/'.$folder.'/meta.txt');
                                    echo $metachka;
                                    echo "<br>$folder";
                                    // $metachkaExploded = explode("#",$metachka);
                                    // foreach($metachkaExploded as $metaInf){
                                    //     echo "$metaInf<br>";
                                    // }
                                }
                                echo "<br>";
                            }
                        }
                        closedir($dx);
                        echo "<br>";
                    }
                }
            }
            closedir($dh);
        }
    }
    ?>

</body>

</html>