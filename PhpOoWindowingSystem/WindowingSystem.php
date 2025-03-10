<?php
class ProgramWindows{
    //la bonne pratique est de laisser en protected
    public $x;
    public $y;
    public $width;
    public $height;

    public function __construct(){
        $this->x = 0;
        $this->y = 0;
        $this->width = 800;
        $this->height = 600;
    
    }

    public function resize($size){
        $this->widht = $size->widht;
        $this->height = $height->height;
    }

    public function move($position){
        $this->x = $position->x;
        $this->y = $position->y;
    }

}

$window = new ProgramWindow();
$window->x; // => null
$window->y; // => null
$window->width; // => null
$window->height; // => null

?>