<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('files/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- waves js -->
<script src="{{ asset('files/assets/pages/waves/js/waves.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
<!-- Float Chart js -->
<script src="{{ asset('files/assets/pages/chart/float/jquery.flot.js') }}"></script>
<script src="{{ asset('files/assets/pages/chart/float/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('files/assets/pages/chart/float/curvedLines.js') }}"></script>
<script src="{{ asset('files/assets/pages/chart/float/jquery.flot.tooltip.min.js') }}"></script>
<!-- Chartlist charts -->
<script src="{{ asset('files/bower_components/chartist/js/chartist.js') }}"></script>
<!-- amchart js -->
<script src="{{ asset('files/assets/pages/widget/amchart/amcharts.js') }}"></script>
<script src="{{ asset('files/assets/pages/widget/amchart/serial.js') }}"></script>
<script src="{{ asset('files/assets/pages/widget/amchart/light.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('files/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('files/assets/js/vertical/vertical-layout.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/js/script.min.js') }}"></script>
@if (!\Auth::check())
    <script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/css-scrollbars.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/js/common-pages.js') }}"></script>
@endif