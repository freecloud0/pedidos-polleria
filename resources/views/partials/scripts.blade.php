<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/js/popper.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('assets/js/detect.js') }}"></script>
<script src="{{ asset('assets/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>

<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('js/mdb.js') }}"></script>


<!-- App js -->
<script src="{{ asset('assets/js/pikeadmin.js') }}"></script>

<!-- BEGIN Java Script for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!-- Counter-Up-->
<script src="{{ asset('assets/plugins/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>


<!--===============================================================================================-->
<script >
    /* validacion css loguin
    $('.js-tilt').tilt({
        scale: 1.1
    }) */
</script>
<!--===============================================================================================-->
<script src="{{ asset('js/main.js') }}"></script>     


<!--===============================================================================================-->
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $(".content-02").fadeOut(1500);
        },5000);
    });
</script>


<!-- ====================== -->
 <script>

    function myFunction() {
    var x = document.getElementById('box');
    if (x.style.backgroundColor === 'orange') {
        x.style.backgroundColor = 'green';
    } else {
        x.style.backgroundColor = 'orange';
    }
}
</script>

<script type="text/javascript">
    $(function() {
      $('#padre > div').hover(function() {
        $('#otro_div').css('background-color', '#336699');
      }, function() {
        // vuelve a dejar el <div> como estaba al hacer el "mouseout"
        $('#otro_div').css('background-color', '');
      });
    });
</script>

<!-- END Java Script for this page -->