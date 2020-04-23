<?php

declare(strict_types = 1);

namespace App\Service\Traits;

trait ResponseHelper{

    /**
     * HTTP 201 Response
     *
     * @param string $message
     * @return mixed
     */
    public function cretead($message = "created"){
        return $this->response->json([
            "message" => $message,
            "code" => 201
        ])->withStatus(201);
    }

    /**
     * HTTP 204 Response
     *
     * @return mixed
     */
    public function noContent($message = "No Content"){
        return $this->response->raw($message)->withStatus(204);
    }


    /**
     * HTTP Error Response
     *
     * @param $httpCode
     * @param string $message
     * @param int $code
     * @return mixed
     */
    private function error($httpCode,$message = "HTTP Erorr",$code = 0){
        return $this->response->json([
            "message" => $message,
            "code" => $code
        ])->withStatus($httpCode);
    }

    public function error404($message="找不到所需的资源",$code=0){
        return $this->error(404,$message,$code);
    }

    public function error403($message="无权限操作资源",$code=0){
        return $this->error(403,$message,$code);
    }

    public function error500($message="服务器错误",$code=0){
        return $this->error(500,$message,$code);
    }

    public function error409($message="不能重复创建资源",$code=0){
        return $this->error(409,$message,$code);
    }

    public function error401($message="认证失败",$code=0){
        return $this->error(401,$message,$code);
    }

    public function error400($message="请求参数错误",$code=0){
        return $this->error(400,$message,$code);
    }

}


?>