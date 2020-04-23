<?php


declare(strict_types = 1);


namespace App\Exception;

use Throwable;

/**
 * 自定义HTTP异常类
 *
 * Class CustomHttpException
 * @package App\Exception
 */

class CustomHttpException extends \Exception{

    protected $errorCode = 0;

    /**
     * CustomHttpException constructor.
     * @param string $message 异常信息
     * @param int $httpCode HTTP 状态码
     * @param int $errorCode 自定义错误码
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $httpCode = 0, $errorCode = 0 ,Throwable $previous = null){
        parent::__construct($message, $httpCode, $previous);
        $this->errorCode = $errorCode;
    }

    public function getErrorCode(){
        return $this->errorCode;
    }

}

?>