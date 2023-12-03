<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquivalentCirculatingController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('index');
        // return view('underconstruction', get_defined_vars());
    }
}