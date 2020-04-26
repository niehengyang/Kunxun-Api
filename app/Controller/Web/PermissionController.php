<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\AbstractController;
use App\EsLogger;
use App\Exception\CustomHttpException;
use App\Model\Permission;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class PermissionController extends AbstractController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {

    }

    /**
     * 命令行获取菜单数据
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function menuList(RequestInterface $request, ResponseInterface $response){
        $columns = ["router","name","uid"];
        $menuList = Permission::where("parent",'root')->menu()->get($columns);
        $menus = $this->getChildrens($menuList,$columns);

        return $response->json(["data" => $menus]);
    }

    /**
     * Web获取菜单
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function webMenuList(RequestInterface $request, ResponseInterface $response){
        $columns = ["router","uid","type","name","icon_type","icon"];
        $menuList = Permission::where("parent",'root')->menu()->get($columns);
        $menus = $this->getChildrens($menuList,$columns);

        return $response->json(["data" => $menus]);
    }

    private function getChildrens($menuList,$columns){
        foreach ($menuList as $menu){
            $menuChildren = Permission::where("parent",$menu->uid)->menu()->get($columns);
            $menu['children'] = $menuChildren;
            $this->getChildrens($menuChildren,$columns);
        }
        return $menuList;
    }


    public function webPermissions(RequestInterface $request, ResponseInterface $response){



        if($this->user()->loginname == 'boom'){

        }
    }
}
