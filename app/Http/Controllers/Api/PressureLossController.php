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

    public function ajaxOutputSurface(Request $request)
    {
        $app = app();
        $returnValue = $app->make('stdClass');
        $returnValue->length = '0';
        $returnValue->id = '0';

        $combination = $request->get('combination');
        $type = $request->get('type');

        switch ($combination) {
            case 'combination_1':
                $returnValue->length = \App\Helpers\Dropdown::listCombination1()[$type];
                break;
            case 'combination_2':
                $returnValue->length = \App\Helpers\Dropdown::listCombination2()[$type];
                break;
            case 'combination_3':
                $returnValue->length = \App\Helpers\Dropdown::listCombination3()[$type];
                break;
            case 'combination_4':
                $returnValue->length = \App\Helpers\Dropdown::listCombination4()[$type];
                break;

            default:
                # code...
                break;
        }

        switch ($type) {
            case 'edp_35':
                $returnValue->id = '2.764';
                break;

            case 'edp_45':
                $returnValue->id = '3.826';
                break;

            case 'edp_50':
                $returnValue->id = '4.276';
                break;
            
            default:
                // code...
                break;
        }

        return response()->json($returnValue);
    }
}
