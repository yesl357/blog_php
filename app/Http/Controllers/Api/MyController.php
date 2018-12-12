<?php

namespace App\Http\Controllers\Api;

use App\Models\My;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\DB;

class MyController extends Controller
{
    public function store(Request $request)
    {
        $key = 'captcha-register-'.str_random(15);

        $captchaBuilder = new CaptchaBuilder();
        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(5);
        \Cache::put($key, $captcha->getPhrase(), $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ];

        return $this->response->array($result)->setStatusCode(201);
    }

    public function me(Request $request)
    {
        $result = DB::table('mys')->first();
        $result = My::query()->first();

        return $this->response->array([
            'author' => $result->author,
            'content' => $result->content,
            'updated_at' => $result->updated_at->diffForHumans()
        ]);
    }
}
