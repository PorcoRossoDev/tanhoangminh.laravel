@extends('dashboard.layout.dashboard')
@section('title')
<title>Cấu hình bảo trì website</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Cấu hình",
        "src" => route('generals.index'),
    ],
    [
        "title" => "Cấu hình bảo trì website",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);

?>
@endsection
@section('content')
<div class="content">
    <div class=" flex items-center mt-8">
        <h1 class="text-lg font-medium mr-auto">
            Cấu hình bảo trì website
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="" method="post" enctype="multipart/form-data">
        <div class="col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class=" box p-5">
                @include('components.alert-error')
                @csrf

                @if( isset($hidden_frontend) )
                <div>
                    <label class="form-label text-base font-semibold">Bảo trì giao diện</label>
                    <span class="text-danger">(Ẩn giao diện bên ngoài Frontend)</span>
                    <div class="form-check form-switch">
                        <input id="checkbox-switch-{{ $hidden_frontend->id }}" data-id={{ $hidden_frontend->id }} <?php echo ($hidden_frontend->data == 1) ? 'checked=""' : ''; ?>
                            class="form-check-input" type="checkbox">
                    </div>
                </div>
                @endif
                
                @if( isset($show_for_admin) )
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Admin có thể xem được giao diện</label>
                    <span class="text-danger"></span>
                    <div class="form-check form-switch">
                        <input id="checkbox-switch-{{ $show_for_admin->id }}" data-id={{ $show_for_admin->id }} <?php echo ($show_for_admin->data == 1) ? 'checked=""' : ''; ?>
                            class="form-check-input for-admin" type="checkbox">
                    </div>
                </div>
                @endif
            </div>

            <!-- END: Form Layout -->
        </div>

    </form>
</div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function() {

            let hiddenFrontend = '<?php echo (isset($hidden_frontend) && $hidden_frontend->data == 1) ? 1 : 0  ?>';
            activeAdmin(hiddenFrontend);

            // Disable nếU option 1 tắt
            function activeAdmin(val = 0) {                                
                if( val == 0 ) {
                    $('.for-admin').attr('disabled', true);
                } else {
                    $('.for-admin').attr('disabled', false);
                }
            }

            $('.form-check-input').change(function() {
                let val = $(this).is(':checked') ? 1 : 0;
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `{{ route('generals.maintenance_update') }}`,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                        val: val
                    },
                    success: function(res){
                        if( res.status == 500 ) {
                            alert('Có lỗi! Vui lòng thử lại')
                        } else {
                            if( id == 1 ) {
                                activeAdmin(val);
                            }
                        }
                    },
                    error: function(){
                        alert('Có lỗi! Vui lòng thử lại');
                    }
                })
            })
        })
    </script>
@endpush