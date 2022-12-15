<?php

namespace App\Helpers;

class Dropdown
{
	public static function listRheologicalModel()
	{
		return [
			'fann_data' => 'Fann Data',
			'power_law' => 'Power - Law',
			'herschel_buckley' => 'Herschel Buckley',
			'bingham_plastic' => 'Bingham Plastic',
			'newtonian_model' => 'Newtonian Model',
		];
	}

	public static function allowedRheologicalModel()
	{
		return array_keys(static::listRheologicalModel());
	}

	public static function listN()
	{
		return [
			'600' => '600',
			'300' => '300',
			'200' => '200',
			'100' => '100',
			'6' => '6',
			'3' => '3',
		];
	}

	public static function allowedN()
	{
		return array_keys(static::listN());
	}

	public static function listCombination1()
	{
		return [
			'standpipe_id' => '3',
			'standpipe_length' => '40',
			'rotary_hose_id' => '2',
			'rotary_hose_length' => '45',
			'swivel_id' => '2',
			'swivel_length' => '4',
			'kelly_pipe_id' => '2.25',
			'kelly_pipe_length' => '40',
			'edp_35' => '437',
			'edp_45' => '161',
			'edp_50' => '0',
		];
	}

	public static function allowedCombination1()
	{
		return array_keys(static::listCombination1());
	}

	public static function listCombination2()
	{
		return [
			'standpipe_id' => '3.5',
			'standpipe_length' => '40',
			'rotary_hose_id' => '2.5',
			'rotary_hose_length' => '55',
			'swivel_id' => '2.5',
			'swivel_length' => '5',
			'kelly_pipe_id' => '3.3',
			'kelly_pipe_length' => '40',
			'edp_35' => '0',
			'edp_45' => '761',
			'edp_50' => '0',
		];
	}

	public static function allowedCombination2()
	{
		return array_keys(static::listCombination2());
	}

	public static function listCombination3()
	{
		return [
			'standpipe_id' => '4',
			'standpipe_length' => '45',
			'rotary_hose_id' => '3',
			'rotary_hose_length' => '55',
			'swivel_id' => '2.5',
			'swivel_length' => '5',
			'kelly_pipe_id' => '3.3',
			'kelly_pipe_length' => '40',
			'edp_35' => '0',
			'edp_45' => '479',
			'edp_50' => '816',
		];
	}

	public static function allowedCombination3()
	{
		return array_keys(static::listCombination3());
	}

	public static function listCombination4()
	{
		return [
			'standpipe_id' => '4',
			'standpipe_length' => '45',
			'rotary_hose_id' => '3',
			'rotary_hose_length' => '55',
			'swivel_id' => '3',
			'swivel_length' => '6',
			'kelly_pipe_id' => '4',
			'kelly_pipe_length' => '40',
			'edp_35' => '0',
			'edp_45' => '340',
			'edp_50' => '576',
		];
	}

	public static function allowedCombination4()
	{
		return array_keys(static::listCombination4());
	}

	public static function listColor()
	{
		return [
			0 => 'rgb(255, 0, 0)',
			1 => 'rgb(60, 179, 113)',
			2 => 'rgb(255, 165, 0)',
			3 => 'rgb(0, 0, 255)',
			4 => 'rgb(238, 130, 238)',
			5 => 'rgb(106, 90, 205)',
			6 => 'rgba(60,141,188)',
			7 => 'rgba(0,0,255)',
			8 => 'rgb(60, 60, 60)',
			9 => 'rgb(90, 90, 90)',
		];
	}

	public static function allowedColor()
	{
		return array_keys(static::listN());
	}
}
