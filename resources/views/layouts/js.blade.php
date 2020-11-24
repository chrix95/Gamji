<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('files/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- waves js -->
<script src="{{ asset('files/assets/pages/waves/js/waves.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>  
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
<!-- Float Chart js -->
<script src="{{ asset('files/assets/pages/chart/float/jquery.flot.js') }}"></script>
<script src="{{ asset('files/assets/pages/chart/float/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('files/assets/pages/chart/float/curvedLines.js') }}"></script>
<script src="{{ asset('files/assets/pages/chart/float/jquery.flot.tooltip.min.js') }}"></script>
<!-- Chartlist charts -->
<script src="{{ asset('files/bower_components/chartist/js/chartist.js') }}"></script>
<!-- data-table js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<!-- amchart js -->
<script src="{{ asset('files/assets/pages/widget/amchart/amcharts.js') }}"></script>
<script src="{{ asset('files/assets/pages/widget/amchart/serial.js') }}"></script>
<script src="{{ asset('files/assets/pages/widget/amchart/light.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('files/assets/pages/data-table/js/data-table-custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/moment-with-locales.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/custom-picker.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/spectrum/js/spectrum.js') }}"></script>
<!-- Date-range picker js -->
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="{{ asset('files/bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script src="{{ asset('files/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('files/assets/js/vertical/vertical-layout.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/js/script.min.js') }}"></script>
@if (!\Auth::check())
    <script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/css-scrollbars.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/js/common-pages.js') }}"></script>
@endif