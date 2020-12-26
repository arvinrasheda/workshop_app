<?php


class GeneralHelper
{
    const ORDER_NEW = "NEW";
    const ORDER_ONPROGRESS = "ONPROGRESS";
    const ORDER_DONE = "DONE";

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

    public function base_path($path = "") {
        return realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR . $path;
    }
}