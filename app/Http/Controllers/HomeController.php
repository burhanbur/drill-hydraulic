<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Imports\ReadExcelImport;

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

        // pressure loss
        // total md
        $total_measured_depth = (double) $request->get('total_measured_depth');

        // hole section
        $cs_length = (double) $request->get('cs_length');
        $cs_depth = (double) $request->get('cs_depth');
        $cs_outer_diameter = (double) $request->get('cs_outer_diameter');
        $cs_inner_diameter = (double) $request->get('cs_inner_diameter');
        $ohs_length = (double) $request->get('ohs_length');
        $ohs_depth = (double) $request->get('ohs_depth');
        $ohs_outer_diameter = (double) $request->get('ohs_outer_diameter');
        $ohs_inner_diameter = (double) $request->get('ohs_inner_diameter');

        // drill string
        $dp_length = (double) $request->get('dp_length');
        $dp_outer_diameter = (double) $request->get('dp_outer_diameter');
        $dp_inner_diameter = (double) $request->get('dp_inner_diameter');
        $dc_length = (double) $request->get('dc_length');
        $dc_outer_diameter = (double) $request->get('dc_outer_diameter');
        $dc_inner_diameter = (double) $request->get('dc_inner_diameter');

        // drilling fluid information
        $mud_density = (double) $request->get('mud_density'); // densitas fluida
        $plastic_viscosity = (double) $request->get('plastic_viscosity');
        $yield_point = (double) $request->get('yield_point');
        $flow_rate = (double) $request->get('flow_rate');

        // parameter bit
        $total_area_nozzle = (double) $request->get('total_area_nozzle');
        $cd = (double) $request->get('cd');

        // surface equipment
        $set_select = $request->get('set_select');
        $edpt_select = $request->get('edpt_select');
        $output_se_edpl = (double) $request->get('output_se_edpl');
        $output_se_edpi = (double) $request->get('output_se_edpi');
        $set_standpipe_id = (double) $request->get('set_standpipe_id');
        $set_standpipe_length = (double) $request->get('set_standpipe_length');
        $set_rotary_hose_id = (double) $request->get('set_rotary_hose_id');
        $set_rotary_hose_length = (double) $request->get('set_rotary_hose_length');
        $set_swivel_id = (double) $request->get('set_swivel_id');
        $set_swivel_length = (double) $request->get('set_swivel_length');
        $set_kelly_pipe_id = (double) $request->get('set_kelly_pipe_id');
        $set_kelly_pipe_length = (double) $request->get('set_kelly_pipe_length');
        $set_edp_35 = (double) $request->get('set_edp_35');
        $set_edp_45 = (double) $request->get('set_edp_45');
        $set_edp_50 = (double) $request->get('set_edp_50');

        $output1 = 0; // surface equipment
        $output2 = []; // inside drill string
        $output3 = 0; // bit
        $output4 = []; // circulating system

        // output surface equipment
        // $mud_density = 10.5;
        // $flow_rate = 300;
        // $output_se_edpi = 3.826;
        // $output_se_edpl = 479;
        // $plastic_viscosity = 35;
        // $yield_point = 6;
        // $cd = 0.95;
        // $total_area_nozzle = 0.28;

        if ($mud_density && $flow_rate && $output_se_edpi && $plastic_viscosity && $yield_point) {
            $condition1 = 928 * ($mud_density * ($flow_rate / (2.448 * $output_se_edpi ** 2)) * $output_se_edpi) / ($plastic_viscosity + (6.66 * $yield_point * $output_se_edpi / ($flow_rate / (2.448 * $output_se_edpi ** 2))));
            
            if ($condition1 < 2100) {
                $output1 = ((($plastic_viscosity * ($flow_rate / (2.448 * $output_se_edpi ** 2)) / 1500 * $output_se_edpi ** 2) + ($yield_point / 225 * $output_se_edpi)) * $output_se_edpi);
            } elseif ($output_se_edpl) {
                $output1 = ($mud_density ** 0.75 * ($flow_rate / (2.448 * $output_se_edpi ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 * ($output_se_edpl) / (1800 * $output_se_edpi ** 1.25));
            }
        }

        // output drill string
        if ($mud_density && $flow_rate && $dp_inner_diameter && $plastic_viscosity && $yield_point && $dp_length) {
            $condition_dp = 928 * ($mud_density * ($flow_rate / (2.448 * $dp_inner_diameter ** 2)) * $dp_inner_diameter) / ($plastic_viscosity + (6.66 * $yield_point * $dp_inner_diameter / ($flow_rate / (2.448 * $dp_inner_diameter ** 2))));

            if ($condition_dp < 2100) {
                $output2['drill_pipe'] = ((($plastic_viscosity * ($flow_rate / (2.448 * $dp_inner_diameter ** 2)) / 1500 * $dp_inner_diameter ** 2) + ($yield_point / 225 * $dp_inner_diameter)) * $dp_length);
            } else {
                $output2['drill_pipe'] = ($mud_density ** 0.75 * ($flow_rate / (2.448 * $dp_inner_diameter ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 * ($dp_length) / (1800 * $dp_inner_diameter ** 1.25));
            }            
        }

        if ($mud_density && $flow_rate && $dc_inner_diameter && $plastic_viscosity && $yield_point && $dc_length) {
            $condition_dc = 928 * ($mud_density * ($flow_rate / (2.448 * $dc_inner_diameter ** 2)) * $dc_inner_diameter) / ($plastic_viscosity + (6.66 * $yield_point * $dc_inner_diameter / ($flow_rate / (2.448 * $dc_inner_diameter ** 2))));;

            if ($condition_dc < 2100) {
                $output2['drill_collar'] = ((($plastic_viscosity * ($flow_rate / (2.448 * $dc_inner_diameter ** 2)) / 1500 * $dc_inner_diameter ** 2) + ($yield_point / 225 * $dc_inner_diameter)) * $dc_length);
            } else {
                $output2['drill_collar'] = ($mud_density ** 0.75 * ($flow_rate / (2.448 * $dc_inner_diameter ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 * $dc_length) / (1800 * $dc_inner_diameter ** 1.25);
            }
        }

        if ($mud_density && $flow_rate && $dp_outer_diameter && $plastic_viscosity && $yield_point && $dp_length && $cs_length && $ohs_inner_diameter) {
            $condition_dp_annulus = 757 * ($mud_density * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dp_outer_diameter ** 2))) * ($ohs_inner_diameter - $dp_outer_diameter)) / ($plastic_viscosity + (5 * $yield_point * ($ohs_inner_diameter - $dp_outer_diameter) / ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dp_outer_diameter ** 2)))));

            if ($condition_dp_annulus < 2100) {
                $output2['drill_pipe_annulus'] = ((($plastic_viscosity * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dp_outer_diameter ** 2)))) / (1000 * ($ohs_inner_diameter - $dp_outer_diameter) ** 2)) + ($yield_point / (200 * ($ohs_inner_diameter - $dp_outer_diameter)))) * ($dp_length - $cs_length);
            } else {
                $output2['drill_pipe_annulus'] = ($mud_density ** 0.75 * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dp_outer_diameter ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 / (1396 * ($ohs_inner_diameter - $dp_outer_diameter) ** 1.25))) * ($dp_length - $cs_length);
            }
        }

        // drill pipe casing annulus
        if ($mud_density && $flow_rate && $dp_outer_diameter && $plastic_viscosity && $yield_point && $dp_length && $cs_length && $cs_inner_diameter) {
            $condition_dp_annulus = 757 * ($mud_density * ($flow_rate / (2.448 * ($cs_inner_diameter ** 2 - $dp_outer_diameter ** 2))) * ($cs_inner_diameter - $dp_outer_diameter)) / ($plastic_viscosity + (5 * $yield_point * ($cs_inner_diameter - $dp_outer_diameter) / ($flow_rate / (2.448 * ($cs_inner_diameter ** 2 - $dp_outer_diameter ** 2)))));

            if ($condition_dp_annulus < 2100) {
                $output2['drill_pipe_casing_annulus'] = ((($plastic_viscosity * ($flow_rate / (2.448 * ($cs_inner_diameter ** 2 - $dp_outer_diameter ** 2)))) / (1000 * ($cs_inner_diameter - $dp_outer_diameter) ** 2)) + ($yield_point / (200 * ($cs_inner_diameter - $dp_outer_diameter)))) * ($cs_length);
            } else {
                $output2['drill_pipe_casing_annulus'] = ($mud_density ** 0.75 * ($flow_rate / (2.448 * ($cs_inner_diameter ** 2 - $dp_outer_diameter ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 / (1396 * ($cs_inner_diameter - $dp_outer_diameter) ** 1.25))) * ($cs_length);
            }
        }

        // drill collar open hole annulus
        // echo "<pre>";
        // var_dump($mud_density);
        // var_dump($flow_rate);
        // var_dump($dc_outer_diameter);
        // var_dump($plastic_viscosity);
        // var_dump($yield_point);
        // var_dump($dc_length);
        // var_dump($ohs_inner_diameter);
        // var_dump($ohs_outer_diameter);
        // die();
        if ($mud_density && $flow_rate && $dc_outer_diameter && $plastic_viscosity && $yield_point && $dc_length && $ohs_inner_diameter) {
            $condition_dc_annulus = 757 * ($mud_density * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2))) * ($ohs_inner_diameter - $dc_outer_diameter)) / ($plastic_viscosity + (5 * $yield_point * ($ohs_inner_diameter - $dc_outer_diameter) / ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)))));

            if ($condition_dc_annulus < 2100) {
                $output2['drill_collar_annulus'] = ((($plastic_viscosity * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)))) / (1000 * ($ohs_inner_diameter - $dc_outer_diameter) ** 2)) + ($yield_point / (200 * ($ohs_inner_diameter - $dc_outer_diameter)))) * ($dc_length);
            } else {
                $output2['drill_collar_annulus'] = ($mud_density ** 0.75 * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 / (1396 * ($ohs_inner_diameter - $dc_outer_diameter) ** 1.25))) * ($dc_length);
            }
        }

        // if ($mud_density && $flow_rate && $dc_outer_diameter && $plastic_viscosity && $yield_point && $dc_length && $ohs_inner_diameter && $cs_depth) {
        //     $condition_dc_annulus = 757 * ($mud_density * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2))) * ($ohs_inner_diameter - $dc_outer_diameter)) / ($plastic_viscosity + (5 * $yield_point * ($ohs_inner_diameter - $dc_outer_diameter) / ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)))));

        //     if ($condition_dc_annulus < 2100) {
        //         $output2['drill_collar_annulus'] = ((($plastic_viscosity * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)))) / 1000 * ($ohs_inner_diameter - $dc_outer_diameter) ** 2) + ($yield_point / (200 * ($ohs_inner_diameter - $dc_outer_diameter))) * ($dc_length));
        //     } else {
        //         $output2['drill_collar_annulus'] = ($mud_density ** 0.75 * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 * ($dc_length - $cs_depth) / (1396 * ($ohs_inner_diameter - $dc_outer_diameter) ** 1.25)));
        //     }
        // }

        // output bit
        if ($mud_density && $flow_rate && $cd && $total_area_nozzle) {
            $output3 = (double) (8.311 * 10 ** -5 * $mud_density * $flow_rate ** 2 / ($cd ** 2 * $total_area_nozzle ** 2));
        }

        // output circulating system
        $output4 = '';

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

    public function ecd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ecd' => 'required',
            'files' => 'required|file|mimes:xlsx,xls|max:25600',
        ]);

        if ($validator->fails()) {
            \Session::flash('error',$validator->errors()->first());

            return redirect()->back();
        }

        $ecd = $request->post('ecd');

        if ($ecd) {
            $path = $request->file('files')->store('temp');
            $realPath = storage_path('app').'/'.$path;
            $rows = (@\Excel::toArray(new ReadExcelImport, $realPath)[0]) ?? [];

            $results = [];
            foreach ($rows as $key => $value) {
                $results[] = $value->id;
            }
        }

        return redirect()->back();
    }

    public function unused()
    {


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
    }
}
