<script src="{{ asset('atlantis') }}/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="{{ asset('atlantis') }}/assets/js/core/popper.min.js"></script>
<script src="{{ asset('atlantis') }}/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{ asset('atlantis') }}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Moment JS -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/moment/moment.min.js"></script>

<!-- Chart JS -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Bootstrap Toggle -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('atlantis') }}/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Google Maps Plugin -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/gmaps/gmaps.js"></script>

<!-- Dropzone -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/dropzone/dropzone.min.js"></script>

<!-- Fullcalendar -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>

<!-- DateTimePicker -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

<!-- Bootstrap Tagsinput -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<!-- Bootstrap Wizard -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

<!-- jQuery Validation -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>

<!-- Summernote -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/summernote/summernote-bs4.min.js"></script>

<!-- Select2 -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/select2/select2.full.min.js"></script>

<!-- Sweet Alert -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Owl Carousel -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/owl-carousel/owl.carousel.min.js"></script>

<!-- Magnific Popup -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Atlantis JS -->
<script src="{{ asset('atlantis') }}/assets/js/atlantis.min.js"></script>

<!-- Datatables -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Sweet Alert -->
<script src=".{{ asset('atl') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Selectize -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

@yield('js')

@if (session('success'))
    <script type="text/javascript">
        swal({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            buttons: {
                confirm: {
                    text: "Oke",
                    value: true,
                    visible: true,
                    className: "btn btn-success",
                    closeModal: true
                }
            }
        });
    </script>
@elseif (session('message'))
    <script>
        $.notify({
            // options
            icon: 'flaticon-check',
            message: 'Login Berhasil'
        }, {
            // settings
            type: 'success'
        });
    </script>
@elseif (session('error'))
<script type="text/javascript">
    swal({
        title: "Gagal!",
        // text: "{{ session('error') }}",
        icon: "error",
        buttons: {
            confirm: {
                text: "Oke",
                value: true,
                visible: true,
                className: "btn btn-danger",
                closeModal: true
            }
        }
    });
</script>
@endif

<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });



    $('#alert_demo_8').click(function(e) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            buttons: {
                cancel: {
                    visible: true,
                    text: 'No, cancel!',
                    className: 'btn btn-danger'
                },
                confirm: {
                    text: 'Yes, delete it!',
                    className: 'btn btn-success'
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    }
                });
            }
        });
    })
</script>
