<footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">LIMATA</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
       
        Developed with <a href="https://getbootstrap.com/">Bootstrap</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('/')}}front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('/')}}front/vendor/aos/aos.js"></script>
  <script src="{{asset('/')}}front/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{asset('/')}}front/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{asset('/')}}front/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="{{asset('/')}}front/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{asset('/')}}front/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('/') }}back/js/core/jquery-3.7.1.min.js"></script>
  <!-- Main JS File -->
  <script src="{{asset('/')}}front/js/main.js"></script>
  
  @yield('content-js')
</body>

</html>