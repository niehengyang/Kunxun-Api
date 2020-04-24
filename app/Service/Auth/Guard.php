<?php

declare(strict_types = 1);


namespace App\Service\Auth;
use App\Exception\CustomHttpException;
use App\Model\Admin;
use Hyperf\Utils\Context;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;


class Guard{

    /**
     * 用户登录
     *
     * @param $loginName
     * @param $password
     * @param $lastLoginIp
     * @return array
     * @throws CustomHttpException
     */
    public static function login($loginName,$password,$lastLoginIp){

        $admin = Admin::query()->where("loginname",$loginName)->first();
        if(!$admin){
           throw new CustomHttpException("用户名或密码错误",401,40101);
        }
        if($admin->password != md5($password)){
            throw new CustomHttpException("用户名或密码错误",401,40102);
        }
        if($admin->status != 1){
            throw new CustomHttpException("账号已被禁用",401,40103);
        }
        //多账号登录
        if($admin->token && $admin->token_expire && (intval($admin['token_expire']) > Carbon::now()->timestamp)){
            $admin->loginip = $lastLoginIp;
            $admin->logintime = Carbon::now();
            $admin->token_expire = self::getExpireAt(60);
            $admin->save();
        }else{
            $admin->token = self::genToken();
            $admin->loginip = $lastLoginIp;
            $admin->logintime = Carbon::now();
            $admin->token_expire = self::getExpireAt(60);
            $admin->created_at = Carbon::now();
            $admin->save();
        }

        $adminArray = $admin->toArray();
        unset($adminArray['password']);
        return [
            "token" => $admin->token,
            'user' => $adminArray
        ];
    }

    /**
     * 生成全局唯一的Token
     *
     * @return mixed
     */
    public static function genToken(){
        return Uuid::uuid1()->toString();
    }

    public static function getExpireAt($expireAt){
        return Carbon::now()->addMinutes($expireAt)->timestamp;
    }

    /**
     * 设置登录用户
     *
     * @param User $user
     */
    public static function setLoginUser(Admin $admin){
        Context::set(Admin::ContextLoginUserKey,serialize($admin));
    }

    /**
     * 获取当前登录用户
     *
     * @return mixed|null|string
     * @throws CustomHttpException
     */
    public static function getLoginUser(){
        $admin = Context::get(User::ContextLoginUserKey);
        $admin = unserialize($admin);
        if($admin instanceof Admin){
            return $admin;
        }
        throw new CustomHttpException("获取的用户数据非Admin实例",500);
    }

    public static function logout(){

    }

}