<?php

declare (strict_types=1);

namespace App\Model;

/**
 */
class Admin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'safe_admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    /**
     * 协程上下文中存储当前登录用户的Key值
     */
    const ContextLoginUserKey="zajx_login_admin";

}