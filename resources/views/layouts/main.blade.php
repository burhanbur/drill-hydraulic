<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('harry.png') }}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css">

  @yield('css')
</head>
<body style="background: rgb(255, 255, 255);">

<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">HARRY UP</a>
    <ul class="navbar-nav">
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
        <a class="nav-link @if (Request::is('drill-hydraulic/ecd*')) active @endif" href="{{ route('ecd') }}">Equivalent Circulating Density</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (Request::is('drill-hydraulic/fmc*')) active @endif" href="{{ route('fmc') }}">Flowrate Minimum Cuttings-done</a>
      </li>
    </ul>
  </div>
</nav>

@yield('container')

<!-- CSS only -->
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->
<!-- JavaScript Bundle with Popper -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

@yield('js')
</body>
</html>


