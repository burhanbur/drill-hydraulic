<div class="modal fade" id="modal-xl" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="" method="GET">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Group</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h3 class="text-center">Fluida Bingham Plastic</h3>
                    <br>
                    <div class="row">

                        <div class="col-md-12">
                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Measurement Depth</strong></legend>
                                <div class="form-group">
                                    <label>Total Measured Depth [ft]</label>
                                    <input type="number" step="any" name="total_measured_depth" class="form-control" required value="{{ ($total_measured_depth) ? $total_measured_depth : '' }}" placeholder="0" />
                                </div>
                            </fieldset>

                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Hole Section</strong></legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Casing Shoe</strong>
                                        <div class="form-group">
                                            <label>Length [ft]</label>
                                            <input type="number" step="any" name="cs_length" class="form-control" required value="{{ ($cs_length) ? $cs_length : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Measurement Depth Base [ft]</label>
                                            <input type="number" step="any" name="cs_depth" class="form-control" required value="{{ ($cs_depth) ? $cs_depth : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Inner Diameter [in]</label>
                                            <input type="number" step="any" name="cs_inner_diameter" class="form-control" required value="{{ ($cs_inner_diameter) ? $cs_inner_diameter : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Outer Diameter [in]</label>
                                            <input type="number" step="any" name="cs_outer_diameter" class="form-control" required value="{{ ($cs_outer_diameter) ? $cs_outer_diameter : '' }}" placeholder="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Open Hole Section</strong>
                                        <div class="form-group">
                                            <label>Length [ft]</label>
                                            <input type="number" step="any" name="ohs_length" class="form-control" required value="{{ ($ohs_length) ? $ohs_length : '' }}" placeholder="0">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Measurement Depth Base [ft]</label>
                                            <input type="number" step="any" name="ohs_depth" class="form-control" required value="{{ ($ohs_depth) ? $ohs_depth : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Inner Diameter [in]</label>
                                            <input type="number" step="any" name="ohs_inner_diameter" class="form-control" required value="{{ ($ohs_inner_diameter) ? $ohs_inner_diameter : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Outer Diameter [in]</label>
                                            <input type="number" step="any" name="ohs_outer_diameter" class="form-control" required value="{{ ($ohs_outer_diameter) ? $ohs_outer_diameter : '' }}" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- 
                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Casing Data Information</strong></legend>
                                <table class="table">
                                    <tr>
                                        <th class="text-center" style="width: 20%;">Casing Type</th>
                                        <th class="text-center">Length [ft]</th>
                                        <th class="text-center hidden">Top Critical Depth</th>
                                        <th class="text-center hidden">Bottom Critical Depth</th>
                                        <th class="text-center">ID [in]</th>
                                        <th class="text-center">OD [in]</th>
                                    </tr>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach(\App\Helpers\Dropdown::listCasingType() as $k => $v)
                                    <tr>
                                        <td class="text-center">{{ $v }}</td>
                                        <td>
                                            <input type="number" step="any" id="casing_length{{$i}}" onkeyup="bottomCriticalDepth({{$i}})" name="casing_length[]" class="form-control" value="{{ @$request->get('casing_length[$i]') }}" required>
                                        </td>
                                        <td class="hidden">
                                            <input type="number" step="any" id="casing_top_citical_depth{{$i}}" name="casing_top_citical_depth[]" class="form-control" value="{{ @$request->get('casing_top_citical_depth[$i]') }}" readonly>
                                        </td>
                                        <td class="hidden">
                                            <input type="number" step="any" id="casing_bottom_citical_depth{{$i}}" name="casing_bottom_citical_depth[]" class="form-control" value="{{ @$request->get('casing_bottom_citical_depth[$i]') }}" readonly>
                                        </td>
                                        <td>
                                            <input type="number" step="any" id="casing_id{{$i}}" name="casing_id[]" class="form-control" value="{{ @$request->get('casing_id[$i]') }}" required>
                                        </td>
                                        <td>
                                            <input type="number" step="any" id="casing_od{{$i}}" name="casing_od[]" class="form-control" value="{{ @$request->get('casing_od[$i]') }}" required>
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                </table>
                            </fieldset>

                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Casing Data Information</strong></legend>
                                <div class="form-group">
                                    <label>Casing Type</label>
                                    <select class="form-control" name="casing_type[]" required>
                                        @foreach(\App\Helpers\Dropdown::listCasingType() as $k => $v)
                                        <option @php echo ($k==@$request->get('casing_type')) ? 'selected' : '' @endphp value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Length [ft]</label>
                                    <input type="number" type="any" name="casing_length[]" class="form-control" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Top Critical Depth</label>
                                            <input type="number" type="any" name="casing_top_citical_depth[]" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bottom Critical Depth</label>
                                            <input type="number" type="any" name="casing_bottom_citical_depth[]" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ID [in]</label>
                                            <input type="number" step="any" name="casing_id[]" class="form-control" required>
                                        </div>                                    
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>OD [in]</label>
                                            <input type="number" step="any" name="casing_od[]" class="form-control" required>
                                        </div>                                    
                                    </div>                                    
                                </div>
                            </fieldset> 

                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Pressure Loss Inside</strong></legend>
                                <table class="table">
                                    <tr>
                                        <th class="text-center">Component</th>
                                        <th class="text-center">Length [ft]</th>
                                        <th class="text-center hidden">Measured Depth [ft]</th>
                                        <th class="text-center">Outer Diameter [ft]</th>
                                        <th class="text-center">Inner Diameter [ft]</th>
                                    </tr>
                                    @php $i = 0 @endphp
                                    @foreach(\App\Helpers\Dropdown::listComponentPsi() as $k => $v)
                                    <tr>
                                        <td>{{ $v }}</td>
                                        <td>
                                            <input type="number" step="any" id="psi_length{{$i}}" name="psi_length[]" onkeyup="psiMd(this.value, '{{$k}}', '{{$i}}')" class="form-control" value="{{ @$request->get('psi_length[$i]') }}" required>
                                        </td>
                                        <td class="hidden">
                                            <input type="number" step="any" id="psi_md{{$i}}" name="psi_md[]" class="form-control" value="{{ @$request->get('psi_md[$i]') }}" readonly>
                                        </td>
                                        <td>
                                            <input type="number" step="any" name="psi_od[]" class="form-control" value="{{ @$request->get('psi_od[$i]') }}" required>
                                        </td>
                                        <td>
                                            <input type="number" step="any" name="psi_id[]" class="form-control" value="{{ @$request->get('psi_id[$i]') }}" required>
                                        </td>
                                    </tr>
                                    @php $i++ @endphp
                                    @endforeach
                                </table>
                            </fieldset> 
                            -->

                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Drill String</strong></legend>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Drill Pipe Length [ft]</label>
                                            <input type="number" step="any" name="dp_length" class="form-control" required value="{{ ($dp_length) ? $dp_length : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Drill Pipe Outer Diameter [in]</label>
                                            <input type="number" step="any" name="dp_outer_diameter" class="form-control" required value="{{ ($dp_outer_diameter) ? $dp_outer_diameter : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Drill Pipe Inner Diameter [in]</label>
                                            <input type="number" step="any" name="dp_inner_diameter" class="form-control" required value="{{ ($dp_inner_diameter) ? $dp_inner_diameter : '' }}" placeholder="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Drill Collar Length [ft]</label>
                                            <input type="number" step="any" name="dc_length" class="form-control" required value="{{ ($dc_length) ? $dc_length : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Drill Collar Outer Diameter [in]</label>
                                            <input type="number" step="any" name="dc_outer_diameter" class="form-control" required value="{{ ($dc_outer_diameter) ? $dc_outer_diameter : '' }}" placeholder="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Drill Collar Inner Diameter [in]</label>
                                            <input type="number" step="any" name="dc_inner_diameter" class="form-control" required value="{{ ($dc_inner_diameter) ? $dc_inner_diameter : '' }}" placeholder="0">
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Drilling Fluid Information</strong></legend>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Mud Density [ppg]</label>
                                            <input type="number" step="any" name="mud_density" class="form-control" required value="{{ ($mud_density) ? $mud_density : '' }}" placeholder="0" />
                                        </div>

                                        <div class="form-group">
                                            <label>Plastic Viscosity (μp) [cP]</label>
                                            <input type="number" step="any" name="plastic_viscosity" class="form-control" required value="{{ ($plastic_viscosity) ? $plastic_viscosity : '' }}" placeholder="0" />
                                        </div>

                                        <div class="form-group">
                                            <label>Total Area Nozzle [inch²]</label>
                                            <input type="number" step="any" name="total_area_nozzle" class="form-control" required value="{{ ($total_area_nozzle) ? $total_area_nozzle : '' }}" placeholder="0" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Yield Point [lb/100 ft2]</label>
                                            <input type="number" step="any" name="yield_point" class="form-control" required value="{{ ($yield_point) ? $yield_point : '' }}" placeholder="0" />
                                        </div>

                                        <div class="form-group">
                                            <label>Flow Rate [gpm]</label>
                                            <input type="number" step="any" name="flow_rate" class="form-control" required value="{{ ($flow_rate) ? $flow_rate : '' }}" placeholder="0" />
                                        </div>

                                        <div class="form-group">
                                            <label>Koeffisien Discharge [0.95]</label>
                                            <input type="number" step="any" name="cd" class="form-control" required value="{{ ($cd) ? $cd : '' }}" placeholder="0" />
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <!-- <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Parameter Bit</strong></legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Densitas Fluida [ppg]</label>
                                            <input type="number" step="any" name="densitas_fluida" class="form-control" required value="{{ @$request->get('densitas_fluida') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Flow Rate [gpm]</label>
                                            <input type="number" step="any" name="flow_rate" class="form-control" required value="{{ @$request->get('flow_rate') }}" />
                                        </div>                                    
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Area Nozzle [inch²]</label>
                                            <input type="number" step="any" name="total_area_nozzle" class="form-control" required value="{{ @$request->get('total_area_nozzle') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Koeffisien Discharge [0.95]</label>
                                            <input type="number" step="any" name="cd" class="form-control" required value="{{ @$request->get('cd') }}" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset> -->

                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Surface Equipment Type</strong></legend>
                                <div class="form-group">
                                    <label>Surface Equipment Type </label>
                                    <br>
                                    <select name="set_select" class="form-control" id="set-select" style="width: 100%;">
                                        @foreach(\App\Helpers\Dropdown::listCombinations() as $k => $v)
                                        <option @php echo ($k == $set_select) ? 'selected' : '' @endphp value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Equivalent Drill Pipe Type </label>
                                    <br>
                                    <select name="edpt_select" class="form-control" id="edpt-select" style="width: 100%;">
                                        @foreach(\App\Helpers\Dropdown::listDrillPipe() as $k => $v)
                                        <option @php echo ($k == $edpt_select) ? 'selected' : '' @endphp value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="hidden">
                                    <div class="form-group">
                                        <label>Equivalent Drill Pipe Length</label>
                                        <input type="number" name="output_se_edpl" id="output_se_edpl" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Equivalent Drill Pipe ID</label>
                                        <input type="number" name="output_se_edpi" id="output_se_edpi" class="form-control" readonly>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Standpipe ID [in]</label>
                                                <input type="number" name="set_standpipe_id" class="form-control" value="" id="set_standpipe_id" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Standpipe Length [ft]</label>
                                                <input type="number" name="set_standpipe_length" class="form-control" value="" id="set_standpipe_length" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Rotary Hose ID [in]</label>
                                                <input type="number" name="set_rotary_hose_id" class="form-control" value="" id="set_rotary_hose_id" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Rotary Hose Length [ft]</label>
                                                <input type="number" name="set_rotary_hose_length" class="form-control" value="" id="set_rotary_hose_length" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Swivel ID [in]</label>
                                                <input type="number" name="set_swivel_id" class="form-control" value="" id="set_swivel_id" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Swivel Length [ft]</label>
                                                <input type="number" name="set_swivel_length" class="form-control" value="" id="set_swivel_length" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Kelly Pipe ID [in]</label>
                                                <input type="number" name="set_kelly_pipe_id" class="form-control" value="" id="set_kelly_pipe_id" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Kelly Pipe Length [ft]</label>
                                                <input type="number" name="set_kelly_pipe_length" class="form-control" value="" id="set_kelly_pipe_length" readonly>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Equivalent Drill Pipe 3.5", 13.3 lb/ft [ft]</label>
                                        <input type="number" name="set_edp_35" class="form-control" value="" id="set_edp_35" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Equivalent Drill Pipe 4.5", 16.6 lb/ft [ft]</label>
                                        <input type="number" name="set_edp_45" class="form-control" value="" id="set_edp_45" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Equivalent Drill Pipe 5", 19.5 lb/ft [ft]</label>
                                        <input type="number" name="set_edp_50" class="form-control" value="" id="set_edp_50" readonly>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>