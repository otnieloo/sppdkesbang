<!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    </body>
 
</html>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js');?>"></script>
    <!-- bootstap bundle js -->
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js');?>"></script>
    <!-- slimscroll js -->
    <script src="<?php echo base_url('assets/vendor/slimscroll/jquery.slimscroll.js');?>"></script>
    <!-- main js -->
    <script src="<?php echo base_url('assets/libs/js/main-js.js');?>"></script>
    <!-- chart chartist js -->
    <script src="<?php echo base_url('assets/vendor/charts/chartist-bundle/chartist.min.js');?>"></script>
    <!-- sparkline js -->
    <script src="<?php echo base_url('assets/vendor/charts/sparkline/jquery.sparkline.js');?>"></script>
    <!-- morris js -->
    <script src="<?php echo base_url('assets/vendor/charts/morris-bundle/raphael.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendor/charts/morris-bundle/morris.js');?>"></script>
     <script src="<?php echo base_url('assets/vendor/charts/morris-bundle/morrisjs.html');?>"></script>
    <!-- chart c3 js -->
    <script src="<?php echo base_url('assets/vendor/charts/c3charts/c3.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendor/charts/c3charts/d3-5.4.0.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendor/charts/c3charts/C3chartjs.js');?>"></script>
    <script src="<?php echo base_url('assets/libs/js/dashboard-ecommerce.js');?>"></script>



    <script src="<?php echo base_url('assets/vendor/charts/chartist-bundle/chartist-plugin-threshold.js');?>"></script>
     <!-- chartjs js -->
    <script src="<?php echo base_url('assets/vendor/charts/charts-bundle/Chart.bundle.js');?>"></script>
    <script src="<?php echo base_url('assets/vendor/charts/charts-bundle/chartjs.js');?>"></script>
     <!-- dashboard finance js -->
    <script src="<?php echo base_url('assets/libs/js/dashboard-finance.js');?>"></script>
     <!-- gauge js -->
    <script src="<?php echo base_url('assets/vendor/gauge/gauge.min.js');?>"></script>
     <!-- daterangepicker js -->
    <script src="<?php echo base_url('../../../../cdn.jsdelivr.net/momentjs/latest/moment.min.js');?>"></script>
    <script src="<?php echo base_url('../../../../cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js');?>"></script>
    <script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
    </script>



    <script src="<?php echo base_url('assets/vendor/parsley/parsley.js');?>"></script>
    <script>
    $('#form').parsley();
    </script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>


    <script src="<?php echo base_url('assets/vendor/datepicker/moment.js');?>"></script>
    <script src="<?php echo base_url('assets/vendor/datepicker/tempusdominus-bootstrap-4.js');?>"></script>
    <script src="<?php echo base_url('assets/vendor/datepicker/datepicker.js');?>"></script>

      <script src="<?php echo base_url('assets/vendor/bootstrap-select/js/bootstrap-select.js');?>"></script>


       <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
  
   <script src="<?php echo base_url('assets/vendor/datatables/datatables-demo.js');?>"></script>

   <script>
    $('.filterme').keypress(function(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
    eve.preventDefault();
  }

  // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
  $('.filterme').keyup(function(eve) {
    if ($(this).val().indexOf('.') == 0) {
      $(this).val($(this).val().substring(1));
    }
  });
});
</script>
<script type="text/javascript">
    function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
 
    return false;
    return true;    
}
</script>

<!-- Jquery untuk menghilangkan nama pengikut jika sudah dipilih sebagai pegawai -->
<script>
    $(document).ready(function(){
        $("#pengikut :checkbox").each(function(){
            this.prop('hidden',true);
        });
        $("#pegawai").change(function(){
            var pilihan = this.value;
            $(':checkbox').removeAttr('disabled');
            $(':checkbox[value='+pilihan+']').prop('disabled','disabled');
        });
    });
</script>

