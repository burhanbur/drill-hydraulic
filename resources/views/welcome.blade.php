<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | User Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <!-- <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="#rheo" class="nav-link active" data-toggle="tab"><i class="fa fa-wrench"></i> Rheological</a>
        </li>
        <li class="nav-item">
            <a href="#pressure" class="nav-link" data-toggle="tab"><i class="fas fa-chart-area"></i> Pressure Loss</a>
        </li>
        <li class="nav-item">
            <a href="#ecd" class="nav-link" data-toggle="tab"><i class="fa fa-cogs"></i> ECD</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="rheo">
            Rheological
        </div>

        <div class="tab-pane" id="pressure">
            pressure loss
        </div>

        <div class="tab-pane" id="ecd">
            ecd
        </div>
    </div> -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a href="#activity" class="nav-link active" role="tab" data-toggle="tab"><i class="fa fa-wrench"></i> Rheological</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#timeline" class="nav-link" role="tab" data-toggle="tab"><i class="fas fa-chart-area"></i> Pressure Loss</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#settings" class="nav-link" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> ECD</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
                                    Rheological
                                </div>

                                <div class="tab-pane" id="timeline">
                                    Pressure Loss
                                </div>

                                <div class="tab-pane" id="settings">
                                    ECD
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte.min.js') }}"></script>
</body>

</html>