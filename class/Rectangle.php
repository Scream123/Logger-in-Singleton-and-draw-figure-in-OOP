<?php


class Rectangle extends Figure
{
    private $width;
    private $height;

    public function __construct($width, $height)
    {
        if (customException::checkNumber($width) == null) {
            $this->width = $width;
        }
        if (customException::checkNumber($height) == null) {
            $this->height = $height;
        }
        echo customException::checkNumber( $width, $height);

    }
// TODO: Implement perimetr() method.
    public function perimeter()
    {
        return $this->width * $this->height;
    }

    // TODO: Implement square() method.
    public function square()
    {
        return ($this->width + $this->height) * 2;
    }
}