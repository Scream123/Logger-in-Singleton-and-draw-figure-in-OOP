<?php


class customException extends Exception
{
    public static function checkNumber($number, $secondNumber = null, $lastNumber = null)
    {
        try {
            if (!is_numeric($number)) {
                throw new Exception('Значение <b>' . $number . ' </b>должно быть числом <br/>');
            }
            if (isset($secondNumber)) {
                if (!is_numeric($secondNumber)) {
                    throw new Exception('Значение <b>' . $number . ' </b>должно быть числом <br/>');
                }
            }
            if (isset($lastNumber)) {
                if (!is_numeric($lastNumber)) {
                    throw new Exception('Значение <b>' . $lastNumber . ' </b>должно быть числом <br/>');
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}