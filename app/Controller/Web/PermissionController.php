<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\AbstractController;
use App\EsLogger;
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
        $menuList = Permission::where("parent",'root')->menu()->get(["router","uid","name"]);
        $menus = $this->getChildrens($menuList);

        return $response->json(["data" => $menus]);
    }

    private function getChildrens($menuList){
        foreach ($menuList as $menu){
            $menuChildren = Permission::where("parent",$menu->uid)->menu()->get(["router","uid","name"]);
            $menu['children'] = $menuChildren;
            $this->getChildrens($menuChildren);
        }
        return $menuList;
    }
}
