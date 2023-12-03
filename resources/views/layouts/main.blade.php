<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('harry.png') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css"> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <!-- <link rel="stylesheet" href="{{ asset('adminlte.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <style>
    .navbar {
      padding-bottom: 0rem;
      padding-top: 0rem;
    }

    .logo-img {
      max-height: 75px;
      max-width: 75px;
    }

    .bg-blue {
      background-color: rgba(8, 73, 153, 1.0);
    }

    .nav-pills .nav-link.active {
      background-color: transparent;
    }
  </style>

  @yield('css')
</head>

<body style="background: rgb(255, 255, 255);">

  <nav class="navbar navbar-expand-lg bg-blue navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img class="logo-img" src="{{ asset('logo/logo-up-putih.png') }}">
      </a>

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
          <i class="fas fa-keyboard"></i> Input Group
        </button>
      </ul>

      <ul class="navbar-nav nav nav-pills">
        {{-- <li class="nav-item">
          <a href="#rheological" class="nav-link" data-toggle="tab"><i class="fa fa-wrench"></i> Rheological</a>
        </li> --}}
        <li class="nav-item">
          <a href="#pressure" class="nav-link active" data-toggle="tab"><i class="fas fa-chart-area"></i> Pressure Loss</a>
        </li>
        <li class="nav-item">
          <a href="#ecd" class="nav-link" data-toggle="tab"><i class="fa fa-cogs"></i> Equivalent Circulating Density</a>
        </li>
      </ul>

      <!-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link @if (Request::is('drill-hydraulic/rheological*')) active @endif" href="{{ route('rheological') }}">Rheological</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (Request::is('drill-hydraulic/pressure-loss*')) active @endif" href="{{ route('pressure.loss') }}">Pressure Loss</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (Request::is('drill-hydraulic/afp*')) active @endif" href="#">AFP</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (Request::is('drill-hydraulic/ecd*')) active @endif" href="{{ route('ecd') }}">ECD</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (Request::is('drill-hydraulic/fmc*')) active @endif" href="{{ route('fmc') }}">FMC</a>
        </li>
      </ul> -->
    </div>
  </nav>

  @yield('container')

  <!-- CSS only -->
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->
  <!-- JavaScript Bundle with Popper -->
  <script src="{{ asset('jquery/jquery.min.js') }}"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3x.6.0/dist/jquery.slim.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> -->
  <!-- <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
  <!-- <script src="{{ asset('adminlte.min.js') }}"></script> -->
  <script src='https://cdn.plot.ly/plotly-2.16.1.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.select2').select2();

      // $('#set-select').select2({
      //   dropdownParent: $('#modal-xl')
      // });

      // $('#edpt-select').select2({
      //   dropdownParent: $('#modal-xl')
      // });
    });
  </script>

  @yield('js')
</body>

</html>