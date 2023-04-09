<div class="container">
    <h3 class="text-center"> Pressure Loss </h3>
    <br>

    <div class="row">
        <div class="col-md-12">
            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss in Surface Equipment</strong></legend>
                <table class="table">
                    <tr></tr>
                </table>
            </fieldset>

            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss inside Drill String</strong></legend>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Component</th>
                            <th class="text-center">Length [ft]</th>
                            <th class="text-center">Measured Depth [ft]</th>
                            <th class="text-center">Outer Diameter [ft]</th>
                            <th class="text-center">Inner Diameter [ft]</th>
                            <th class="text-center">Pressure Loss inside [psi]</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0 @endphp
                        @foreach(\App\Helpers\Dropdown::listComponentPsi() as $k => $v)
                        <!-- <tr>
                            <td>{{ $v }}</td>
                            <td>
                                {{ @$request->get('psi_length[$i]') }}
                            </td>
                            <td>
                                {{ @$request->get('psi_md[$i]') }}
                            </td>
                            <td>
                                {{ @$request->get('psi_od[$i]') }}
                            </td>
                            <td>
                                {{ @$request->get('psi_id[$i]') }}
                            </td>
                            <td></td>
                        </tr> -->
                        @php $i++ @endphp
                        @endforeach
                        <tr>
                            <td>Drill Pipe</td>
                            <td>
                                9500
                            </td>
                            <td>
                                9500
                            </td>
                            <td>
                                4,5
                            </td>
                            <td>
                                3,826
                            </td>
                            <td>605,6575537</td>
                            <td>19.613,9835537</td>
                        </tr>
                        <tr>
                            <td>Drill Collar</td>
                            <td>
                                450
                            </td>
                            <td>
                                9950
                            </td>
                            <td>
                                6,75
                            </td>
                            <td>
                                2,25
                            </td>
                            <td>340,0354962</td>
                            <td>10.749,0354962</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-center">Total</th>
                            <th>945,6930499</th>
                            <th>30.363,0190499</th>
                        </tr>
                    </tfoot>
                </table>
            </fieldset>


            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss in Bit</strong></legend>
                <table class="table">
                    <tr></tr>
                </table>
            </fieldset>

            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss in Annulus</strong></legend>
                <table class="table">
                    <tr>
                        <th class="text-center" style="width: 20%;">Component</th>
                        <th class="text-center">Annulus System</th>
                        <th class="text-center">ID [in]</th>
                        <th class="text-center">OD [in</th>
                        <th class="text-center">Length [ft]</th>
                        <th class="text-center">Drill Pipe</th>
                        <th class="text-center">Drill Collar</th>
                    </tr>
                    @php
                        $i = 0;
                    @endphp
                    @foreach(\App\Helpers\Dropdown::listCasingType() as $k => $v)
                    <!-- <tr>
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
                    </tr> -->
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
                    </tr>
                </table>
            </fieldset>

            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss in Circulating System</strong></legend>
                <table class="table">
                    <tr></tr>
                </table>
            </fieldset>
        </div>
    </div>
</div>