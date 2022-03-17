<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoControllers extends Controller
{
    function index(){
        $image = base64_encode(file_get_contents(public_path('/public/images/logo_full.jpg')));
        return $image;
    }
}
