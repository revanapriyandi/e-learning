<meta charset="UTF-8">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }} @if (!Request::is('dashboard'))  @yield('title') @endif</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css') }}" />
<link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}" />

<link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-float-label.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/component-custom-switch.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('css/dore.light.blue.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/vendor/glide.core.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/nouislider.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
<link rel="stylesheet" href="{{ asset('css/vendor/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/select2-bootstrap.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="{{ asset('css/main.css') }}" />

<link rel="stylesheet" href="{{ asset('css/vendor/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/datatables.responsive.bootstrap4.min.css') }}" />
@yield('css')
