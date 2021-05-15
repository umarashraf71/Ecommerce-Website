<footer class="br-footer">
    
    </footer>


    <script src="../assets/lib/jquery/jquery.min.js"></script>
    <script src="../assets/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="../assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/lib/moment/min/moment.min.js"></script>
    <script src="../assets/lib/peity/jquery.peity.min.js"></script>
    <script src="../assets/lib/rickshaw/vendor/d3.min.js"></script>
    <script src="../assets/lib/rickshaw/vendor/d3.layout.min.js"></script>
    <script src="../assets/lib/rickshaw/rickshaw.min.js"></script>
    <script src="../assets/lib/jquery.flot/jquery.flot.js"></script>
    <script src="../assets/lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="../assets/lib/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../assets/lib/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../assets/lib/echarts/echarts.min.js"></script>
    <script src="../assets/lib/select2/js/select2.full.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAq8o5-8Y5pudbJMJtDFzb8aHiWJufa5fg"></script>
    <script src="../assets/lib/gmaps/gmaps.min.js"></script>

    <script src="../assets/js/bracket.js"></script>
    <script src="../assets/js/map.shiftworker.js"></script>
    <script src="../assets/js/ResizeSensor.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script>
      $(function(){
        'use strict'

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
          minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
          if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
          } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
          }
        }
      });
    </script>


    <script>
        
        setTimeout(function()
        {
          $('#message').fadeOut('fast');
        }, 2700); // <-- time in milliseconds



    //for input file
        var fileInput = document.querySelector('input[type=file]');
        var filenameContainer = document.querySelector('.fileclick');
        var dropzone = document.querySelector('.fileclick');

        fileInput.addEventListener('change', function() {
          filenameContainer.innerText = fileInput.value.split('\\').pop();
        });

        fileInput.addEventListener('dragenter', function() {
          dropzone.classList.add('dragover');
        });

        fileInput.addEventListener('dragleave', function() {
          dropzone.classList.remove('dragover');
        });


    //for zooming the image

    // Get the modal
    var modal = document.getElementById("myModal");
    var body = document.querySelector('body');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    img.onclick = function(){

      modal.style.display = "block";
      body.style.overflow = "hidden";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeImage")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
      body.style.overflow = "scroll";
    }


    </script>

  </body>
</html>
