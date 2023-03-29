<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquivalentCirculatingController extends Controller
{
    public function index(Request $request)
    {
        $returnValue = [];

        return response()->json($returnValue);
    }
}