<!-- app js -->
<script src="assent/dist/js/app.js"></script>
<!-- jQuery -->
<script src="assent/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assent/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assent/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assent/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assent/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assent/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assent/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assent/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assent/plugins/moment/moment.min.js"></script>
<script src="assent/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assent/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assent/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assent/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assent/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assent/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assent/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="assent/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assent/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assent/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assent/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!--  -->
<script>
    feather.replace()
</script>
<script>
    function handlePanInput(e) {
        var ss = e.target.selectionStart;
        var se = e.target.selectionEnd;
        e.target.value = e.target.value.toUpperCase();
        e.target.selectionStart = ss;
        e.target.selectionEnd = se;
    }
</script>
<!--  -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>