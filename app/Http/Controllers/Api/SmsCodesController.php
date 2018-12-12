<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SmsCodeRequest;

class SmsCodesController extends Controller
{
    public function store(SmsCodeRequest $request)
    {
        $captchaData = \Cache::get($request->captcha_key);

        if (!$captchaData) {
            return $this->response->error('图片验证码已失效', 422);
        }

        if (!hash_equals($captchaData, $request->captcha_code)) {

            \Cache::forget($request->captcha_key);
            return $this->response->errorUnauthorized('验证码错误');
        }

        $mobile = $request->mobile;

        //发送验证码
        if (!app()->environment('production')) {
            $code = '1234';
        }else{

            $code = str_pad(random_int(1, 999999), 4, 0, STR_PAD_LEFT);

            try {
                $result = app('easysms')->send($mobile, [
                    'template' => 'SMS_134150201',
                    'data' => [
                        'code' => $code
                    ],
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                return $this->response->errorInternal($message ?? '短信发送异常');
            }

        }

        $key = 'smsCode_'.$mobile.'_'.str_random(15);
        $expiredAt = now()->addMinutes(5);
        // 缓存验证码 5分钟过期。
        \Cache::put($key, ['mobile' => $mobile, 'code' => $code], $expiredAt);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);

    }
}
