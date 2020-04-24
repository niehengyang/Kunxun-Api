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
            "uid" => "device",
            "name" => "设备管理",
            "type" => 0,
            "router" => "/device",
            "parent" => "root",
            "icon_type" => null,
            "icon" => null
        ]);
        Db::table("permissions")->insert([
            "uid" => "device.list",
            "name" => "设备列表",
            "type" => 0,
            "parent" => "device",
            "router" => "/device/list",
            "icon_type" => null,
            "icon" => null
        ]);
        Db::table("permissions")->insert([
            "uid" => "device.type",
            "name" => "设备类型",
            "type" => 0,
            "parent" => "device",
            "router" => "/device/type",
            "icon_type" => null,
            "icon" => null
        ]);
    }
}
