<?php 

namespace App\Services;

use Illuminate\Http\Request;

class PressureLossService
{
	public function calculate(Request $request)
	{
		$returnValue = [];

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
        $output4 = 0; // circulating system

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
                $output2['drill_pipe_annulus'] = ((($plastic_viscosity * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dp_outer_diameter ** 2)))) / 1000 * ($ohs_inner_diameter - $dp_outer_diameter) ** 2) + ($yield_point / (200 * ($ohs_inner_diameter - $dp_outer_diameter))) * ($dp_length - $cs_length));
            } else {
                $output2['drill_pipe_annulus'] = ($mud_density ** 0.75 * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dp_outer_diameter ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 * ($dp_length - $cs_length) / (1396 * ($ohs_inner_diameter - $dp_outer_diameter) ** 1.25)));
            }
        }

        if ($mud_density && $flow_rate && $dc_outer_diameter && $plastic_viscosity && $yield_point && $dc_length && $ohs_inner_diameter && $cs_depth) {
            $condition_dc_annulus = 757 * ($mud_density * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2))) * ($ohs_inner_diameter - $dc_outer_diameter)) / ($plastic_viscosity + (5 * $yield_point * ($ohs_inner_diameter - $dc_outer_diameter) / ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)))));

            if ($condition_dc_annulus < 2100) {
                $output2['drill_collar_annulus'] = ((($plastic_viscosity * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)))) / 1000 * ($ohs_inner_diameter - $dc_outer_diameter) ** 2) + ($yield_point / (200 * ($ohs_inner_diameter - $dc_outer_diameter))) * ($dc_length));
            } else {
                $output2['drill_collar_annulus'] = ($mud_density ** 0.75 * ($flow_rate / (2.448 * ($ohs_inner_diameter ** 2 - $dc_outer_diameter ** 2)) ** 1.75 * $plastic_viscosity ** 0.25 * ($dc_length - $cs_depth) / (1396 * ($ohs_inner_diameter - $dc_outer_diameter) ** 1.25)));
            }
        }

        // output bit
        if ($mud_density && $flow_rate && $cd && $total_area_nozzle) {
            $output3 = (double) (8.311 * 10 ** -5 * $mud_density * $flow_rate ** 2 / ($cd ** 2 * $total_area_nozzle ** 2));
        }

        // output circulating system
        $output4 = @$output1 + @$output2['drill_pipe'] + @$output2['drill_pipe_annulus'] + @$output2['drill_collar'] + @$output2['drill_collar_annulus'] + @$output3;

        $returnValue = [
        	'output1' => $output1,
        	'output2' => $output2,
        	'output3' => $output3,
        	'output4' => $output4
        ];

		return $returnValue;
	}
}