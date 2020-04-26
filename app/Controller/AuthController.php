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
use App\Request\Auth\WebLoginRequest;
use App\Service\Auth\Decrypt;
use App\Service\Auth\Guard;
use Hyperf\HttpServer\Contract\ResponseInterface;

class AuthController extends AbstractController
{
    public function webLogin(WebLoginRequest $request, ResponseInterface $response)
    {
        EsLogger::get()->debug($request->all());

        $loginname = $request->input('loginname');
        $password = $request->input('password');
        $boomDecrypt = new Decrypt();
        $decryptPwd = $boomDecrypt->cryptoJsAesDecrypt($password);
        $login_data = Guard::login($loginname,$decryptPwd,$request->input('ip',null));
        return $response->json($login_data);
    }


}
