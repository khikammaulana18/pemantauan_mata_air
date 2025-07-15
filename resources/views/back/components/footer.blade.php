<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
        <div class="copyright">
            <p>© <span>Copyright</span> <strong>LIMATA</strong> <span>All Rights Reserved</span></p>
        </div>
        <div>
            Developed with
            <a target="_blank" href="https://getbootstrap.com/">Bootstrap</a>.
        </div>
    </div>
</footer>
</div>
<!-- End Custom template -->
</div>
<!--   Core JS Files   -->
<script src="{{ asset('/') }}back/js/core/jquery-3.7.1.min.js"></script>
<script src="{{ asset('/') }}back/js/core/popper.min.js"></script>
<script src="{{ asset('/') }}back/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('/') }}back/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Sweet Alert -->
<script src="{{ asset('/') }}back/js/plugin/sweetalert/sweetalert2.min.js"></script>


<!-- Kaiadmin JS -->
<script src="{{ asset('/') }}back/js/kaiadmin.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->

@yield('content-js')

<script>
  $(document).ready(function(){
    $('.form-confirm').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: "Apakah anda yakin ?",
            text: "Anda tidak bisa mengubah atau membatalkan proses ini !",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya!",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            } else if (result.isDenied) {
                Swal.fire('Gagal', '', 'error')
            }
        });
    });
  })
 
  $(document).on('click', '.form-confirm', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: "Apakah anda yakin ?",
            text: "Anda tidak bisa mengubah atau membatalkan proses ini !",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya!",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            } else if (result.isDenied) {
                Swal.fire('Gagal', '', 'error')
            }
        });
    });

   
    $(document).on('click', '.a-confirm', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Apakah Anda yakin untuk melakukan proses ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.isConfirmed) {
                var base_url = $(this).attr('href');
                $.ajax({
                    url: base_url,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Proses telah dilakukan dengan Berhasil',
                            button: 'Ok'
                        }).then((confrimed) => {
                            window.location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Proses gagal dilakukan !',
                            button: 'Ok'
                        }).then((confrimed) => {
                            window.location.reload();
                        });
                    }
                });
            }
        })
    });
</script>
</body>

</html>
