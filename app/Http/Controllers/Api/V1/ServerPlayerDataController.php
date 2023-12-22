<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ApiTest;
use Illuminate\Http\Request;

class ServerPlayerDataController extends Controller
{
    public function create(Request $request) {
        $data = $request->data;
        $test = new ApiTest;
        $test->data = $data;
        $test->save();
        print($data);
    }
}
