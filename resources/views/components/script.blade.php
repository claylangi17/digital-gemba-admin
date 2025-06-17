    <!-- jQuery library js -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <!-- Apex Chart js -->
    <script src="{{ asset('assets/js/lib/apexcharts.min.js') }}"></script>
    <!-- Data Table js -->
    <script src="{{ asset('assets/js/lib/simple-datatables.min.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    <!-- jQuery UI js -->
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    <!-- Vector Map js -->
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- Popup js -->
    <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
    <!-- Slick Slider js -->
    <script src="{{ asset('assets/js/lib/slick.min.js') }}"></script>
    <!-- prism js -->
    <script src="{{ asset('assets/js/lib/prism.js') }}"></script>
    <!-- file upload js -->
    <script src="{{ asset('assets/js/lib/file-upload.js') }}"></script>
    <!-- audio player -->
    <script src="{{ asset('assets/js/lib/audioplayer.js') }}"></script>

    <script src="{{ asset('assets/js/flowbite.min.js') }}"></script>

    {{-- Virtual Select  --}}
    <script src="{{ asset('assets/js/lib/virtual-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/tooltip.min.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @livewireScripts
    @stack('lv-scripts')

    <script>
        window.addEventListener('lv-toast-success', event => {
            console.log();
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: event.detail[0].message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        });

        Livewire.on('lv-delete-confirm', (event) => {
            Swal.fire({
                title: 'Hapus ' + event.itemName + '?',
                text: "Apakah kamu yakin untuk menghapus " + event.itemName + " ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(event.confirmationListener, { id: event.itemId })
                }
            })
        });
    </script>

    <?php echo (isset($script) ? $script   : '')?>