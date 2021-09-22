<?php


class Circle extends Figure
{
    private $radius;

    public function __construct($radius)
    {
        if (customException::checkNumber($radius) == null) {
            $this->radius = $radius;
        }
        echo customException::checkNumber($radius);
    }

    // TODO: Implement square() method.
    public function square()
    {

        return M_PI * $this->radius * $this->radius;
    }

    // TODO: Implement perimetr() method.
    public function perimeter()
    {
        return 2 * M_PI * $this->radius;
    }
}