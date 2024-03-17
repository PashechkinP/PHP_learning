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
        echo "Author: ".$this->author ."<br>"."Name: ". $this->name ."<br>"."Pages: ". $this->pages ."<br>"."Year: ". $this->year ."<br>"."Cover: ". $this->cover."<br>";
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
        return parent::ShowInfo()."Source: ".$this->source."<br>";
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
        return parent::ShowInfo()."Artist: ".$this->artist ."<br>"."Colour: ".$this->colour."<br>";
    }
}
?>


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
            while (($folder = readdir($dh)) !== false) {
                if ($folder == '.' || $folder == '..') continue;
                if (is_dir($folder)) {
                    // echo "каталог: $folder <br>"; // nazvanie papki-knigi

                    if($dx = opendir($folder)){
                        while (($file = readdir($dx)) !== false){
                            if ($file == '.' || $file == '..') continue;
                            if (!is_dir($file)){
                                $pngExt =".png";
                                $metaTxt ="meta.txt";
                                if(str_contains($file,$pngExt)){
                                    echo "<img style='width:200px;height:300px;border:2px solid black' src='$folder/$file' />";
                                    echo "<br>";
                                    
                                }
                                
                                // echo "файл:    $file <br>";    // nazvanie vseh failov v papke

                                //находим файл с метаинфой и читаем его
                                if (str_contains($file, $metaTxt)) {
                                    $metachka = file_get_contents(__DIR__ . '/'.$folder.'/meta.txt');
                                    
                                    $metachkaExploded = explode("#",$metachka);

                                    switch($metachkaExploded[0]){

                                        case "book":
                                            $bookObj = new Book($metachkaExploded[2],$metachkaExploded[4],$metachkaExploded[6],$metachkaExploded[8],$metachkaExploded[10]);
                                            $bookObj->ShowInfo();
                                            break;

                                        case "comics":
                                            $comicsObj = new Book($metachkaExploded[2],$metachkaExploded[4],$metachkaExploded[6],$metachkaExploded[8],$metachkaExploded[10],$metachkaExploded[12],$metachkaExploded[14]);
                                            $comicsObj->ShowInfo();
                                            break;    

                                        case "fiction":
                                            $fictionObj = new Book($metachkaExploded[2],$metachkaExploded[4],$metachkaExploded[6],$metachkaExploded[8],$metachkaExploded[10],$metachkaExploded[12]);
                                            $fictionObj->ShowInfo();
                                            break;

                                            default: break;
                                    }

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
</div>
</body>

</html>