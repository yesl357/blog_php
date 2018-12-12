<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller as BaseController;

header("Access-Control-Allow-Origin: *");
class Controller extends BaseController
{
    use Helpers;
}