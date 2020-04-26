<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;

class BoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('admin')->insert([
            "loginname" => "boom",
            "password" => md5("82325588")
        ]);

        Db::table("permissions")->insert([
            "uid" => "system",
            "name" => "系统管理",
            "type" => 0,
            "router" => "/system",
            "parent" => "root",
            "icon_type" => null,
            "icon" => null
        ]);
        Db::table("permissions")->insert([
            "uid" => "system.nav",
            "name" => "菜单配置",
            "type" => 0,
            "parent" => "system",
            "router" => "/system/nav",
            "icon_type" => null,
            "icon" => null
        ]);
    }
}
