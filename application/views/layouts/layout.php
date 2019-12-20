<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<?php $this->load->view('includes/header');?>
<body>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <script src="<?php echo base_url();?>assets/js/javaScript/jquery-3.4.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery-ui/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/bootstrap/js/popper.min.js"></script>
    
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
    <script src="<?php echo base_url()?>assets/bootstrap-4.4.0-dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/bootstrap-4.4.0-dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url()?>assets/js/javaScript/jquery.matchHeight.min.js"></script>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <?php $this->load->view('includes/left_panel');?>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php $this->load->view('includes/top_bar');?>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <?php $this->load->view($subview);?>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <?php $this->load->view('includes/footer');?>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="<?php echo base_url()?>assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="<?php echo base_url()?>assets/js/javaScript/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="<?php echo base_url()?>assets/js/javaScript/chartist.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/javaScript/chartist-plugin-legend.min.js"></script>

    <script src="<?php echo base_url()?>assets/js/lib/flot-chart/jquery.flot.js"></script>
    <script src="<?php echo base_url()?>assets/js/lib/flot-chart/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url()?>assets/js/lib/flot-chart/jquery.flot.spline.min.js"></script>

    <!--<script src="<?php echo base_url()?>assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/lib/weather/weather-init.js"></script>-->

    <script src="<?php echo base_url()?>assets/js/javaScript/moment.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/javaScript/fullcalendar.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/init/fullcalendar-init.js"></script>

    <!--Last add by me-->
   
    <!--<script src="<?php echo base_url()?>assets/js/lib/datatables/datatables.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/init/datatables-init.js"></script>-->

 <!--   <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/v4-shims.js"></script>-->

</body>
</html>
