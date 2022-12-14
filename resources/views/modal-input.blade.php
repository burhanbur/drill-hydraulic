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
                                <legend class="reset"><strong>Casing Data Information</strong></legend>
                                <table class="table">
                                    <tr>
                                        <th class="text-center" style="width: 20%;">Casing Type</th>
                                        <th class="text-center">Length [ft]</th>
                                        <th class="text-center">Top Critical Depth</th>
                                        <th class="text-center">Bottom Critical Depth</th>
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
                                        <td>
                                            <input type="number" step="any" id="casing_top_citical_depth{{$i}}" name="casing_top_citical_depth[]" class="form-control" value="{{ @$request->get('casing_top_citical_depth[$i]') }}" readonly>
                                        </td>
                                        <td>
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

                            <!-- <fieldset class="border p-3 reset">
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
                            </fieldset> -->
                        </div>

                        <div class="col-md-12">
                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Pressure Loss Inside</strong></legend>
                                <table class="table">
                                    <tr>
                                        <th class="text-center">Component</th>
                                        <th class="text-center">Length [ft]</th>
                                        <th class="text-center">Measured Depth [ft]</th>
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
                                        <td>
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
                        </div>

                        <div class="col-md-6">
                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Informasi Kedalaman</strong></legend>
                                <div class="form-group">
                                    <label>Total Measured Depth [ft]</label>
                                    <input type="number" step="any" name="total_measured_depth" class="form-control" required value="{{ @$request->get('total_measured_depth') }}" />
                                </div>
                            </fieldset>

                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Drilling Fluid Information</strong></legend>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Mud Density [ppg]</label>
                                            <input type="number" step="any" name="mud_density" class="form-control" required value="{{ @$request->get('mud_density') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label>Plastic Viscosity (??p) [cP]</label>
                                            <input type="number" step="any" name="plastic_viscosity" class="form-control" required value="{{ @$request->get('plastic_viscosity') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Yield Point [lb/100 ft2]</label>
                                            <input type="number" step="any" name="yield_point" class="form-control" required value="{{ @$request->get('yield_point') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label>Flow Rate [gpm]</label>
                                            <input type="number" step="any" name="flow_rate" class="form-control" required value="{{ @$request->get('flow_rate') }}" />
                                        </div>

                                    </div>
                                </div>

                            </fieldset>

                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Drill String</strong></legend>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Drill Pipe Length [ft]</label>
                                            <input type="number" step="any" name="dp_length" class="form-control" required value="{{ @$request->get('dp_length') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Drill Pipe Outer Diameter [in]</label>
                                            <input type="number" step="any" name="dp_outer_diameter" class="form-control" required value="{{ @$request->get('dp_outer_diameter') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Drill Pipe Inner Diameter [in]</label>
                                            <input type="number" step="any" name="dp_inner_diameter" class="form-control" required value="{{ @$request->get('dp_inner_diameter') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Drill Collar Length [ft]</label>
                                            <input type="number" step="any" name="dc_length" class="form-control" required value="{{ @$request->get('dc_length') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Drill Collar Outer Diameter [in]</label>
                                            <input type="number" step="any" name="dc_outer_diameter" class="form-control" required value="{{ @$request->get('dc_outer_diameter') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Drill Collar Inner Diameter [in]</label>
                                            <input type="number" step="any" name="dc_inner_diameter" class="form-control" required value="{{ @$request->get('dc_inner_diameter') }}">
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <div class="col-md-6">
                            <fieldset class="border p-3 reset">
                                <legend class="reset"><strong>Input Surface Equipment Type</strong></legend>
                                <div class="form-group">
                                    <label>Surface Equipment Type </label>
                                    <br>
                                    <select name="set_select" class="form-control" id="set-select" style="width: 100%;">
                                        @foreach(\App\Helpers\Dropdown::listCombinations() as $k => $v)
                                        <option @php echo ($k==@$request->get('set_select')) ? 'selected' : '' @endphp value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Equivalent Drill Pipe Type </label>
                                    <br>
                                    <select name="edpt_select" class="form-control" id="edpt-select" style="width: 100%;">
                                        @foreach(\App\Helpers\Dropdown::listDrillPipe() as $k => $v)
                                        <option @php echo ($k==@$request->get('edpt_select')) ? 'selected' : '' @endphp value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Output Surface Equipment</label>
                                    <input type="text" name="output_se_edpl" id="output_se_edpl" class="form-control" readonly>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Standpipe ID [in]</label>
                                            <input type="text" name="set_standpipe_id" class="form-control" value="" id="set_standpipe_id" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Standpipe Length [ft]</label>
                                            <input type="text" name="set_standpipe_length" class="form-control" value="" id="set_standpipe_length" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Rotary Hose ID [in]</label>
                                            <input type="text" name="set_rotary_hose_id" class="form-control" value="" id="set_rotary_hose_id" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Rotary Hose Length [ft]</label>
                                            <input type="text" name="set_rotary_hose_length" class="form-control" value="" id="set_rotary_hose_length" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Swivel ID [in]</label>
                                            <input type="text" name="set_swivel_id" class="form-control" value="" id="set_swivel_id" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Swivel Length [ft]</label>
                                            <input type="text" name="set_swivel_length" class="form-control" value="" id="set_swivel_length" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Kelly Pipe ID [in]</label>
                                            <input type="text" name="set_kelly_pipe_id" class="form-control" value="" id="set_kelly_pipe_id" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Kelly Pipe Length [ft]</label>
                                            <input type="text" name="set_kelly_pipe_length" class="form-control" value="" id="set_kelly_pipe_length" readonly>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Equivalent Drill Pipe 3.5", 13.3 lb/ft [ft]</label>
                                    <input type="text" name="set_edp_35" class="form-control" value="" id="set_edp_35" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Equivalent Drill Pipe 4.5", 16.6 lb/ft [ft]</label>
                                    <input type="text" name="set_edp_45" class="form-control" value="" id="set_edp_45" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Equivalent Drill Pipe 5", 19.5 lb/ft [ft]</label>
                                    <input type="text" name="set_edp_50" class="form-control" value="" id="set_edp_50" readonly>
                                </div>
                            </fieldset>
                        </div>

                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>