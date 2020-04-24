<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\EsLogger;

class IndexController extends AbstractController
{
    public function index()
    {
        EsLogger::get()->debug(__METHOD__);

        $user = $this->request->input('user', 'Boom');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }
}
