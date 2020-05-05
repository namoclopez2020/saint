  
  
  <!-- JavaScript files-->
  <script src="./libs/vendor/jquery/jquery.min.js"></script>
    <script src="./libs/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./libs/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="./libs/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="./libs/vendor/chart.js/Chart.min.js"></script>
    <script src="./libs/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="./libs/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
       <!--librerias de autocomplete -->

    <script src="./libs/vendor/ui-autocomplete/js/jquery-ui.min.js"></script>
        
    <!-- Bootstrap Select-->
    <script src="./libs/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <!-- Bootstrap Touchspin-->
    <script src="./libs/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Bootstrap No UI Slider-->
    <script src="./libs/vendor/nouislider/nouislider.min.js"></script>
    <!-- Bootstrap DatePicker-->
    <script src="./libs/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap Tags Input-->
    <script src="./libs/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <!-- Jasny Bootstrap - Input Masks-->
    <script src="./libs/vendor/jasny-bootstrap/js/jasny-bootstrap.min.js"> </script>
    <!-- MultiSelect-->
    <script src="./libs/vendor/multiselect/js/jquery.multi-select.js"> </script>
    <!-- Forms init-->
    <script src="./libs/js/forms-advanced.js"></script>
      <!-- Notifications -->
      <script src="./libs/vendor/messenger-hubspot/build/js/messenger.min.js">   </script>
    <script src="./libs/vendor/messenger-hubspot/build/js/messenger-theme-flat.js">       </script>
    <!--<script src="./libs/js/home-premium.js"> </script>-->
    
     <!-- Data Tables-->
   <!--  <script src="./libs/vendor/datatables.net/js/jquery.dataTables.js"></script>
    <script src="./libs/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="./libs/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./libs/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    -->

    <!--datatables probar -->
    <script src="./libs/vendor/datatable-responsive-input/datatables.min.js"></script>
    <script src="./libs/js/tables-datatable.js"></script>
  
    <!--sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Main File-->
    <script src="./libs/js/front.js"></script>

  
   	<script>
     function display_msg(mensaje,tipo){
      $(function () {

Messenger.options = {
    extraClasses: 'messenger-fixed messenger-on-top  messenger-on-right',
    theme: 'flat',
    messageDefaults: {
        showCloseButton: true
    }
}
Messenger().post({
            message: mensaje,
            type: tipo
        });

});
     }
       $(function () {

Messenger.options = {
    extraClasses: 'messenger-fixed messenger-on-top  messenger-on-right',
    theme: 'flat',
    messageDefaults: {
        showCloseButton: true
    }
}
<?php echo display_msg($msg); ?>

});
     </script>
  </body>
</html>