<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlowrateMinimumController extends Controller
{
    public function index(Request $request)
    {
        return view('underconstruction', get_defined_vars());
    }
}