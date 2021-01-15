<!-- Favicon icon -->
<link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">
<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">
<!-- waves.css -->
<link rel="stylesheet" href="{{ asset('files/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
<!-- feather icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/feather/css/feather.css') }}">
<!-- font-awesome-n -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/font-awesome-n.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datedropper/css/datedropper.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/spectrum/css/spectrum.css') }}" />

<!-- Chartlist chart css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/chartist/css/chartist.css') }}" type="text/css" media="all">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/widget.css') }}">
@if (!\Auth::check())
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/pages.css') }}">    
@endif
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/custom.css') }}">
<!-- Vue Bootstrap Styles -->
<!-- Scripts -->
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}