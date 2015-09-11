<!-- jQuery -->
        <script type="text/javascript">
            $(function() {

                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

            });
        </script>




<?php if($datatables == 'active'){ ?>
<!-- DATA TABES SCRIPT -->
<script src="<?php echo $baseurl ?>/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo $baseurl ?>/js/dataTables.bootstrap.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
    $(function() {
        $('#searchtable').dataTable({});
        $('#datatable').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
<?php } ?>



<?php if($gamemenu == 'active'){ ?>

        <!-- date-range-picker -->
        <script src="<?php echo $baseurl ?>/js/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo $baseurl ?>/js/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

        <!-- Page script -->
        <script type="text/javascript">
            $(function() {
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 1, format: 'MM/DD/YYYY h:mm A'});
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
<?php } ?>

