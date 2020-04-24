<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        //账号表
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loginname')->comment("账号");
            $table->string('password')->comment("登录密码");
            $table->bigInteger('status')->default(1)->comment("用户状态（1：可用 0：禁用）");
            $table->string('token')->comment("token")->nullable();
            $table->string('token_expire')->comment("token过期时间")->nullable();
            $table->string('loginip')->comment("登录ip")->nullable();
            $table->string('logintime')->comment("登录时间")->nullable();
            $table->timestamps();
        });

        //权限表
        Schema::create("permissions", function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string("uid")->comment("权限uid，唯一标识");
            $table->string("name",30)->nullable()->comment("权限名称");
            $table->char('type',1)->comment("权限类型，0：菜单，1：操作");
            $table->string("parent")->comment("上级权限的uid，根级其parent为root");
            $table->string("router")->nullable()->comment("前端路由");
            $table->char("icon_type",1)->nullable()->comment("图标类型");
            $table->string("icon")->nullable()->comment("图标的url或类名等");
            $table->string("uri")->nullable()->comment("后端路由");
            $table->string("http_method")->nullable()->comment("后端路由的HttpMethod");
            $table->string('desc')->nullable()->comment("权限描述");
            $table->string("template")->nullable()->comment("前端模板");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
}
