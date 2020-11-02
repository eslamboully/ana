<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(!auth()->user()->hasPackage() && \Illuminate\Support\Facades\Request::segment(1) != 'profile')
    <script>
        const swalWithBootstrapButtons2 = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger edit-margin-cancel-button'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons2.fire({
            title: '{{ __('front.subscribe_sorry') }}',
            text: '{{ __('front.subscribe_sorry_desc') }}',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: '{{ __('front.no_subscribe') }}',
            confirmButtonText: '{{ __('front.yes_subscribe') }}',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('profile') }}';
            }
        });
    </script>
@endif
