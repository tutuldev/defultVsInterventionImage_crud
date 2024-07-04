<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testindex(){
        // return view('test');
        echo 'this is test page 20';
    }
}
