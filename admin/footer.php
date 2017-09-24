<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://www.pmu.edu.my/v5/">POLITEKNIK MUKAH, SARAWAK</a>.</strong> All rights
    reserved.
</footer>

<div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        setInterval(function(){
            load_last_notification();
            getTotalUnread();
        }, 3000);

        function load_last_notification()
        {
            $.ajax({
                url:"fetch.php?type=msg",
                method:"POST",
                success:function(data)
                {
                    $('.contact_us').html(data);
                }
            })
        }

        function getTotalUnread()
        {
            $.ajax({
                url:"fetch.php?type=total",
                method:"POST",
                success:function(data)
                {
                    $('.total_msg').html(data);
                }
            })
        }

        $('#comment_form').on('submit', function(event){
            event.preventDefault();
            if($('#subject').val() != '' && $('#comment').val() != '')
            {
                var form_data = $(this).serialize();
                $.ajax({
                    url:"insert.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        $('#comment_form')[0].reset();
                    }
                })
            }
            else
            {
                alert("Both Fields are Required");
            }
        });
    });
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/Chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>

<!-- CK Editor -->
<script src="bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

