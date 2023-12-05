<div class="container">
    <h3 class="text-center"> Equivalent Circulating Density </h3>
    <br>

    @if (Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('store.ecd') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>Unggah data PPFG</label>
                <div class="form-group">
                    <input type="file" name="files" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                </div>
                <br>
                <button type="submit" name="ecd" value="ecd" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Submit</button>
                <a href="{{ asset('template-ecd.xlsx') }}" class="btn btn-success"><i class="fa fa-download"></i>&nbsp; Download Template</a>
            </form>

            <br>

            <table>
                <tr>
                    <td>Cutting Density (ppg)</td>
                    <td>: <strong>{{ $cuttingDensity }}</strong></td>
                </tr>
                <tr>
                    <td>Cutting Concentration (%)</td>
                    <td>: <strong>{{ $cuttingConcentration }}</strong></td>
                </tr>
            </table>

            <br><br>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>Depth 1</th>
                                <th>Pore Pressure</th>
                                <th>Fracture Pressure</th>
                            </tr>
                            <tr>
                                <th>(ft)</th>
                                <th>(ppg)</th>
                                <th>(ppg)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
                            <tr>
                                <td>{{ $value['depth_1'] }}</td>
                                <td>{{ $value['pp'] }}</td>
                                <td>{{ $value['fp'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>True Vertical Depth</th>
                                <th>ECD</th>
                            </tr>
                            <tr>
                                <th>(ft)</th>
                                <th>(ppg)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $key => $value)
                            <tr>
                                <td>{{ $value['tvd'] }}</td>
                                <td>{{ $value['ecd'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div id="myDiv"></div>
        </div>
    </div>
</div>