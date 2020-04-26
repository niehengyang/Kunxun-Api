<?php

declare(strict_types=1);

namespace App\Middleware;

use App\EsLogger;
use App\Exception\CustomHttpException;
use App\Model\Admin;
use App\Service\Auth\Guard;

use Carbon\Carbon;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Hyperf\HttpServer\Contract\ResponseInterface as Response;
use Hyperf\HttpServer\Contract\RequestInterface as Request;

class WebAuthMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Request;
     */
    protected $request;

    /**
     * @var Response;
     */
    protected $response;

    public function __construct(ContainerInterface $container , Request $request , Response $response)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        EsLogger::get()->debug(__METHOD__);

        $token = false;
        if($this->request->hasHeader("Authorization")){
            $token = $this->request->header("Authorization");
        }elseif($this->request->has("X-Token")){
            $token = $this->request->input("X-Token");
        }
        if(false === $token){
            throw new CustomHttpException("未设置Token",401,40101);
        }
        $admin = Admin::query()->where("token",$token)->first();

        if(!$admin){
            throw new CustomHttpException("无效的token，请重新登录",401,40101);
        }
        if(intval($admin->token_expire) < Carbon::now()->timestamp){
            throw new CustomHttpException("token已过期，请重新登录",401,40101);
        }
        //延长token过期时间
        $admin->token_expire = Guard::getExpireAt(60);
        $admin->save();

        Guard::setLoginUser($admin);

        return $handler->handle($request);

        return $handler->handle($request);
    }
}