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

    public function menuList(RequestInterface $request, ResponseInterface $response){
        $menuList = Permission::where("parent",'root')->menu()->get();


        return $response->json(["data" => $menuList]);
    }

    public function store(RequestInterface $request, ResponseInterface $response){

        $uid = $request->input('uid_name');
        $parentId = $request->input('parentId');


        if($parentId == 0) {
            $parent = 'root';
            $uidPrefix = '';
        } else {
            $parent = Permission::query()->find($parentId)->uid;
            $uidPrefix = $parent.'.';
        }

        $permission = new Permission($request->all());
        $permission->uid = $uidPrefix.$uid;
        $permission->parent = $parent;

        $permission->save();
        return ;
    }

    private function getChildrens($menuList){
        foreach ($menuList as $menu){

        }
    }
}
