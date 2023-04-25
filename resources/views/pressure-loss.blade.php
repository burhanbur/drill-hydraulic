<div class="container">
    <h3 class="text-center"> Pressure Loss </h3>
    <br>

    <div class="row">
        <div class="col-md-12">
            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss in Surface Equipment</strong></legend>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Component</th>
                            <th class="text-center">Pressure Loss inside [psi]</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Surface Equipment</td>
                            <td class="text-center">{{ $output1 }}</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss inside Drill String</strong></legend>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Component</th>
                            <!-- <th class="text-center">Length [ft]</th>
                            <th class="text-center">Measured Depth [ft]</th>
                            <th class="text-center">Outer Diameter [ft]</th>
                            <th class="text-center">Inner Diameter [ft]</th> -->
                            <th class="text-center">Pressure Loss inside [psi]</th>
                            <th class="text-center">Pressure Loss in Annulus [psi]</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0 @endphp
                        @foreach(\App\Helpers\Dropdown::listComponentPsi() as $k => $v)
                        <tr>
                            <td class="text-center">{{ $v }}</td>

                            @if ($k == 'drill_pipe')
                                <td class="text-center">{{ @$output2['drill_pipe'] }}</td>
                                <td class="text-center">{{ @$output2['drill_pipe_annulus'] }}</td>
                                <td class="text-center">{{ @$output2['drill_pipe'] + @$output2['drill_pipe_annulus'] }}</td>
                            @else
                                <td class="text-center">{{ @$output2['drill_collar'] }}</td>
                                <td class="text-center">{{ @$output2['drill_collar_annulus'] }}</td>
                                <td class="text-center">{{ @$output2['drill_collar'] + @$output2['drill_collar_annulus'] }}</td>
                            @endif
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                        @php $total_output2 = @$output2['drill_pipe'] + @$output2['drill_pipe_annulus'] + @$output2['drill_collar'] + @$output2['drill_collar_annulus'] @endphp
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">Total</th>
                            <th class="text-center">{{ @$output2['drill_pipe'] + @$output2['drill_collar'] }}</th>
                            <th class="text-center">{{ @$output2['drill_pipe_annulus'] + @$output2['drill_collar_annulus'] }}</th>
                            <th class="text-center">{{ $total_output2 }}</th>
                        </tr>
                    </tfoot>
                </table>
            </fieldset>


            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss in Bit</strong></legend>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Mud Density</th>
                            <th class="text-center">Flow Rate</th>
                            <th class="text-center">Total Area Nozzle</th>
                            <th class="text-center">Koeffisien Discharge</th>
                            <th class="text-center">Bit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $mud_density }}</td>
                            <td class="text-center">{{ $flow_rate }}</td>
                            <td class="text-center">{{ $total_area_nozzle }}</td>
                            <td class="text-center">{{ $cd }}</td>
                            <td class="text-center">{{ $output3 }}</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            {{-- 
            <!-- <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss in Annulus</strong></legend>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 20%;">Component</th>
                            <th class="text-center">Annulus System</th>
                            <th class="text-center">ID [in]</th>
                            <th class="text-center">OD [in</th>
                            <th class="text-center">Length [ft]</th>
                            <th class="text-center">Drill Pipe</th>
                            <th class="text-center">Drill Collar</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach(\App\Helpers\Dropdown::listCasingType() as $k => $v)
                        <tr>
                            <td class="text-center">{{ $v }}</td>
                            <td>
                                <select class="form-control" id="annulus_system{{$i}}">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach

                        <tr>
                            <td class="text-center">Surface Casing</td>
                            <td>
                                <select class="form-control" id="">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </td>
                            <td>13.375</td>
                            <td>17.5</td>
                            <td>3000</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-center">Intermediate Casing</td>
                            <td>
                                <select class="form-control" id="">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </td>
                            <td>11</td>
                            <td>12.25</td>
                            <td>4500</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-center">Production Casing</td>
                            <td>
                                <select class="form-control" id="">
                                    <option value="yes">Yes</option>
                                </select>
                            </td>
                            <td>8.755</td>
                            <td>9.625</td>
                            <td>6500</td>
                            <td>73,13159102</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-center">Open Hole</td>
                            <td>
                                <select class="form-control" id="">
                                    <option value="yes">Yes</option>
                                </select>
                            </td>
                            <td>8.5</td>
                            <td>8.5</td>
                            <td>3000</td>
                            <td>37,96592195</td>
                            <td>31,33028949</td>
                            <td>31,33028949</td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-center">Total</th>
                            <th>945,6930499</th>
                            <th>30.363,0190499</th>
                            <th>30.363,0190499</th>
                        </tr>
                    </tfoot>
                </table>
            </fieldset> -->
            --}}

            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss in Circulating System</strong></legend>
                <table class="table">
                    <tr>
                        <th>Pressure Loss in Circulating System [psi]</th>
                        <td>: {{ $output1 + $total_output2 + $output3 }}</td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </div>
</div>