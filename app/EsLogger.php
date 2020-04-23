<?php

namespace App;

use Hyperf\Utils\ApplicationContext;

class EsLogger
{
    public static function get(string $name = 'app')
    {
        return ApplicationContext::getContainer()->get(\Hyperf\Logger\LoggerFactory::class)->get($name);
    }
}