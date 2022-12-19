<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // rheological
        $nParam = ['600', '300', '200', '100', '6', '3'];

        $n = [];
        $dialReading = $request->get('dial_reading_fann_data');
        $model = $request->get('model');

        if ($dialReading && !in_array(0, $dialReading)) {
            $n = [
                '600', '300', '200', '100', '6', '3'
            ];
        }

        // chart
        $xChartValues = [];
        $yChartValues = [];

        if ($model == 'semua') {
            $yChartValues['fann_data'] = [];
            $yChartValues['power_law'] = [];
            $yChartValues['herschel_buckley'] = [];
            $yChartValues['bingham_plastic'] = [];
            $yChartValues['newtonian_model'] = [];
        }

        for ($i = 0; $i < count((array) $n); $i++) {
            switch ($model) {
                case 'fann_data':
                    $val = 0.01065 * (float) @$dialReading[$i] * 0.0069444444443639;
                    $yChartValues[] = (is_nan($val)) ? 0 : $val;

                    break;

                case 'power_law':
                    $cColumn = $n[$i] * 1.70333;
                    $dColumn = log10(((float) @$dialReading[0] * 1.70333) / ((float) @$dialReading[1] * 1.70333)) * 3.32192809;
                    $eColumn = ((510 * (float) @$dialReading[0]) / (pow((1.703 * $n[0]), $dColumn))) * 0.001;
                    $fColumn = $eColumn * (pow($cColumn, $dColumn));
                    $gColumn = $fColumn * 0.000145038;

                    $yChartValues[] = (is_nan($gColumn)) ? 0 : $gColumn;
                    break;

                case 'herschel_buckley':
                    $dColumnParam2 = (2 * (float) @$dialReading[5]) - (float) @$dialReading[4];
                    $dColumnParam = $dColumnParam2 * 0.47880258888889;
                    $eColumn = 3.32192809 * (log10(((float) @$dialReading[0] - $dColumnParam2) / ((float) @$dialReading[1] - $dColumnParam2)));
                    $fColumn = 500 * (((float) @$dialReading[1] - $dColumnParam2) / (pow(511, $eColumn))) * 0.001;

                    $cColumn = $n[$i] * 1.70333;
                    $gColumn = ($dColumnParam + ($fColumn * pow($cColumn, $eColumn)));
                    $hColumn = $gColumn * 0.000145038;

                    $yChartValues[] = (is_nan($hColumn)) ? 0 : $hColumn;
                    break;

                case 'bingham_plastic':
                    $dColumnParam = ((300 / ($n[0] - $n[1])) * ((float) @$dialReading[0] - (float) @$dialReading[1]) * 0.001);
                    $dColumnParam2 = ((300 / ($n[0] - $n[1])) * ((float) @$dialReading[0] - (float) @$dialReading[1]));
                    $eColumn = ((float) @$dialReading[1] - $dColumnParam2) * 0.47880258888889;

                    $cColumn = $n[$i] * 1.70333;
                    $fColumn = ($eColumn + ($dColumnParam * $cColumn));
                    $gColumn = $fColumn * 0.000145038;

                    $yChartValues[] = (is_nan($gColumn)) ? 0 : $gColumn;
                    break;

                case 'newtonian_model':
                    $cColumn = $n[$i] * 1.70333;
                    $dColumn = ((300 / $n[0]) * (float) @$dialReading[0]) * 0.001;
                    $eColumn = $dColumn * $cColumn;
                    $fColumn = $eColumn * 0.000145038;

                    $yChartValues[] = (is_nan($fColumn)) ? 0 : $fColumn;
                    break;

                case 'semua':
                    // fann data
                    $val = 0.01065 * (float) @$dialReading[$i] * 0.0069444444443639;
                    $yChartValues['fann_data'][] = (is_nan($val)) ? 0 : $val;

                    // power law
                    $cColumn = $n[$i] * 1.70333;
                    $dColumn = log10(((float) @$dialReading[0] * 1.70333) / ((float) @$dialReading[1] * 1.70333)) * 3.32192809;
                    $eColumn = ((510 * (float) @$dialReading[0]) / (pow((1.703 * $n[0]), $dColumn))) * 0.001;
                    $fColumn = $eColumn * (pow($cColumn, $dColumn));
                    $gColumn = $fColumn * 0.000145038;

                    $yChartValues['power_law'][] = (is_nan($gColumn)) ? 0 : $gColumn;

                    // herschel buckley
                    $dColumnParam2 = (2 * (float) @$dialReading[5]) - (float) @$dialReading[4];
                    $dColumnParam = $dColumnParam2 * 0.47880258888889;
                    $eColumn = 3.32192809 * (log10(((float) @$dialReading[0] - $dColumnParam2) / ((float) @$dialReading[1] - $dColumnParam2)));
                    $fColumn = 500 * (((float) @$dialReading[1] - $dColumnParam2) / (pow(511, $eColumn))) * 0.001;

                    $cColumn = $n[$i] * 1.70333;
                    $gColumn = ($dColumnParam + ($fColumn * pow($cColumn, $eColumn)));
                    $hColumn = $gColumn * 0.000145038;

                    $yChartValues['herschel_buckley'][] = (is_nan($hColumn)) ? 0 : $hColumn;

                    // bingham plastic
                    $dColumnParam = ((300 / ($n[0] - $n[1])) * ((float) @$dialReading[0] - (float) @$dialReading[1]) * 0.001);
                    $dColumnParam2 = ((300 / ($n[0] - $n[1])) * ((float) @$dialReading[0] - (float) @$dialReading[1]));
                    $eColumn = ((float) @$dialReading[1] - $dColumnParam2) * 0.47880258888889;

                    $cColumn = $n[$i] * 1.70333;
                    $fColumn = ($eColumn + ($dColumnParam * $cColumn));
                    $gColumn = $fColumn * 0.000145038;

                    $yChartValues['bingham_plastic'][] = (is_nan($gColumn)) ? 0 : $gColumn;

                    // newtonian model
                    $cColumn = $n[$i] * 1.70333;
                    $dColumn = ((300 / $n[0]) * (float) @$dialReading[0]) * 0.001;
                    $eColumn = $dColumn * $cColumn;
                    $fColumn = $eColumn * 0.000145038;

                    $yChartValues['newtonian_model'][] = (is_nan($fColumn)) ? 0 : $fColumn;
                    break;

                default:

                    break;
            }
        }

        foreach ($n as $ns) {
            $xChartValues[] = round((float) $ns * 1.70333, 3);
        }

        // pressure loss

        // ecd

        return view('dashboard', get_defined_vars());
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

    public function ajaxOutputSurfaceEquipment(Request $request)
    {
        $output = '0';
        $combination = $request->get('combination');
        $type = $request->get('type');

        switch ($combination) {
            case 'combination_1':
                $output = \App\Helpers\Dropdown::listCombination1()[$type];
                break;
            case 'combination_2':
                $output = \App\Helpers\Dropdown::listCombination2()[$type];
                break;
            case 'combination_3':
                $output = \App\Helpers\Dropdown::listCombination3()[$type];
                break;
            case 'combination_4':
                $output = \App\Helpers\Dropdown::listCombination4()[$type];
                break;

            default:
                # code...
                break;
        }
        return response()->json($output);
    }
}
