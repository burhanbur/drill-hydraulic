<div class="container">
    <h3 class="text-center"> Pressure Loss </h3>
    <br>

    <div class="row">
        <div class="col-md-12">
            <fieldset class="border p-3 reset">
                <legend class="reset"><strong>Output Pressure Loss inside [psi]</strong></legend>
                <table class="table">
                    <tr>
                        <th class="text-center">Component</th>
                        <th class="text-center">Length [ft]</th>
                        <th class="text-center">Measured Depth [ft]</th>
                        <th class="text-center">Outer Diameter [ft]</th>
                        <th class="text-center">Inner Diameter [ft]</th>
                        <th class="text-center">Pressure Loss inside [psi]</th>
                    </tr>
                    @php $i = 0 @endphp
                    @foreach(\App\Helpers\Dropdown::listComponentPsi() as $k => $v)
                    <tr>
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
                    </tr>
                    @php $i++ @endphp
                    @endforeach
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
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </table>
            </fieldset>
        </div>
    </div>
</div>