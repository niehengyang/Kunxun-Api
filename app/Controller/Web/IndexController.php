<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\AbstractController;
use App\EsLogger;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class IndexController extends AbstractController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {

        //日志记录
//        EsLogger::get()->debug("test ...");

        // Response助手
        //完整方法查看Service/Trait/ResponseHelper
//        $this->error404();
//        $this->error400();
//        $this->cretead();
//        $this->noContent();


        //获取当前登录用户
        // 返回当前登录用户的Model对象
        //$this->user();


        //返回JSON
//        return ['name'=>'bb'];

//        return $response->raw('Hello Hyperf!');
    }
}
