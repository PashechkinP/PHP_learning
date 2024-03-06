<?php
abstract class Literature{

    function __construct(protected $author, protected $name, protected $pages, protected $year, protected $cover)
    {
        $this->author=$author;
        $this->name=$name;
        $this->pages=$pages;
        $this->year=$year;
        $this->cover=$cover;
    }

    function ShowInfo(){
        echo $this->author. $this->name. $this->pages. $this->year. $this->cover;
    }

}

class TextLiterature extends Literature{



}

class ImgLiterature extends Literature{



}


//====================================================================================================

class FunFiction extends TextLiterature{

    function __construct($author, $name, $pages, $year, $cover, protected $source)
    {
        $this->author=$author;
        $this->name=$name;
        $this->pages=$pages;
        $this->year=$year;
        $this->cover=$cover;
        $this->source=$source;
    }

    function ShowInfo(){
      return parent::ShowInfo();

    }
}

class Book extends TextLiterature{

    function __construct($author, $name, $pages, $year, $cover)
    {
        $this->author=$author;
        $this->name=$name;
        $this->pages=$pages;
        $this->year=$year;
        $this->cover=$cover;
    }

    function ShowInfo($thing){
        return;
    }
}

class Comics extends ImgLiterature{

    function __construct($author, $name, $pages, $year, $cover, protected $artist, protected $colour)
    {
        $this->author=$author;
        $this->name=$name;
        $this->pages=$pages;
        $this->year=$year;
        $this->cover=$cover;
        $this->artist=$artist;
        $this->colour=$colour;
    }

    function ShowInfo($thing){
        return;
    }
}
?>