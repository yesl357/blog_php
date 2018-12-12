<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Doctrine\DBAL\Version;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //pFp78OJ8CsYm3qEpQLbRZubYl8xDITWdA5BG8WJQ
    public function store(UserRequest $request)
    {
        $key = $request->captcha_key;
        $captchaCodeData = \Cache::get($key);
        if (!$captchaCodeData) {
            return $this->response->error('验证码已失效', 401);
        }

        if (!hash_equals($captchaCodeData, $request->captcha_code)) {
            \Cache::forget($key);
            return $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::create([
            'name' => 'YSLBLOG'.str_random(5),
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
        ]);


         //清除验证码缓存
        \Cache::forget($key);

        return $this->response->item($user, new UserTransformer())->setStatusCode(201);
    }


    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }
}
