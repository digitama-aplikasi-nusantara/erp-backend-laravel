<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use stdClass;

class IndexController extends Controller
{
    public function index()
    {
        $data = new stdClass();
        $data->message = "Who Are You?";
        return $this->success($data, "Welcome Home");
    }
}
