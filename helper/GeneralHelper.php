<?php


class GeneralHelper
{
    public function random($lenght, $isOnlyNumber = false)
    {
        if ($isOnlyNumber) {
            $char = '123456789';
        } else {
            $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        }
        $string = '';
        for ($i = 0; $i < $lenght; $i++) {
            $pos = rand(0, strlen($char) - 1);
            $string .= $char{$pos};
        }
        return $string;
    }
}