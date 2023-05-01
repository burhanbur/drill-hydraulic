<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PressureLossService;

class PressureLossController extends Controller
{
    public $errorMessage;

    public function __construct()
    {
        $this->errorMessage = 'Woops, looks like something went wrong.';
    }

    public function index(Request $request)
    {
        $returnValue = [];
        
        $logic = new PressureLossService;
        $returnValue = $logic->calculate($request);

        return response()->json($returnValue);
    }
}