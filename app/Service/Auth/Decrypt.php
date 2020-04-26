<?php

declare(strict_types = 1);

namespace App\Service\Auth;

class Decrypt{


    /**向量
     * @var string
     */
    protected $IV = "1234567890123456";//16位
    protected $KEY = "1234567890654321";//16位

    /**
     * 解密字符串
     * @param string $str 字符串
     * @return string
     */
    public function cryptoJsAesDecrypt($str){
        $str = str_replace(' ','+',$str);

        $jsondata = openssl_decrypt($str, 'aes-128-cbc', $this->KEY, OPENSSL_ZERO_PADDING , $this->IV);

        return trim($jsondata);
    }
}