<?php


class Triangle extends Figure
{
    private $height;
    private $width;
    private $side;


    public function __construct($height, $width, $side)
    {
        if (customException::checkNumber($height, $width, $side) == null) {
            $this->height = $height;$this->side = $side;    $this->width = $width;
        }
        echo  customException::checkNumber($height);
    }

    public function square()
    {
        // TODO: Implement square() method.
        return ($this->width * $this->height) / 2;
    }

    // TODO: Implement perimetr() method.
    public function perimeter()
    {
        return $this->side + $this->width + $this->height;
    }

}