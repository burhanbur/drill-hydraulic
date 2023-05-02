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

    public function combination()
    {
        $returnValue = \App\Helpers\Dropdown::listCombinations();

        return response()->json($returnValue);
    }

    public function drillPipe()
    {
        $returnValue = \App\Helpers\Dropdown::listDrillPipe();

        return response()->json($returnValue);
    }

    public function ajaxCombination(Request $request)
    {
        $combination = [];
        $req = $request->get('combination');

        switch ($req) {
            case 'combination_1':
                $combination = \App\Helpers\Dropdown::listCombination1();
                break;
            case 'combination_2':
                $combination = \App\Helpers\Dropdown::listCombination2();
                break;
            case 'combination_3':
                $combination = \App\Helpers\Dropdown::listCombination3();
                break;
            case 'combination_4':
                $combination = \App\Helpers\Dropdown::listCombination4();
                break;

            default:
                // $combination = \App\Helpers\Dropdown::listCombination1();
                break;
        }

        return response()->json($combination);
    }
}
