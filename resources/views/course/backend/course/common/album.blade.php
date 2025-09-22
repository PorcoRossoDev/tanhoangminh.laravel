<div>
    @if( $action == 'update' )
        <div class="text-right">
            <button type="button" id="uploadBtn" class="btn btn-primary mb-2.5">Upload ảnh</button>
        </div>
    @endif
  <input type="file" 
  class="filepond"
  name="filepond[]"
  multiple />
  <input type="hidden" name="album_order" id="albumOrder">
</div>
@push('javascript')
<!-- 1. Các plugin -->
<script src="https://unpkg.com/filepond-plugin-file-reorder/dist/filepond-plugin-file-reorder.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-reorder/dist/filepond-plugin-file-reorder.min.js"></script>

<!-- 2. FilePond core -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Đăng ký tất cả plugin
    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateSize,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
    );

    let existingFiles = []
    @if( !empty($detail->image_json) )
        existingFiles = @json(json_decode($detail->image_json, true)).map(url => ({
            source: url,
            options: {
                type: 'remote',       // bắt buộc để preview từ URL
                metadata: {
                    poster: url       // hiển thị preview từ URL
                }
            }
        }));
    @endif

    console.log(existingFiles)

    const pond = FilePond.create(document.querySelector('input.filepond'), {
        allowMultiple: true,
        maxFiles: 10,
        maxFileSize: '10MB',
        files: existingFiles,
        allowReorder: true, // Bật kéo thả
        labelIdle: '<div>Kéo thả ảnh hoặc <span class="filepond--label-action">Chọn file</span></div><div>(Tối đa 10 ảnh và dung lương giới hạn là 10Mb)</div>',
    });

    // const formData = new FormData();
    // pond.on('addfile', (error, file) => {
    //     if (!error) {
    //         console.log('Đã thêm file:', file.file.name, file.file.size, file.file.type);
    //         // Đẩy file vào FormData
    //       formData.append('filepond[]', file.file, file.file.name);

    //       @if( $action == 'update' )
    //         formData.append('id', '{{ $detail->id ?? 0 }}');
    //         fetch('{{ route("course.add_image") }}', {
    //                 method: 'POST',
    //                 headers: {
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //                 },
    //                 body: formData
    //             })
    //             .then(res => res.json())
    //             .then(data => {
    //                 console.log("Upload thành công:", data);
    //                 // Bạn có thể gán lại metadata cho file để sau còn xử lý xóa
    //                 file.setMetadata('serverId', data.id || data.url);
    //             })
    //             .catch(err => console.error("Upload lỗi:", err));
    //         @endif
    //     }
    // });

    // pond.on('addfile', (error, file) => {
    //     if (error) return;

    //     // chỉ upload nếu là file mới từ input
    //     if (file.origin !== FilePond.FileOrigin.INPUT) return;
    //     console.log('file.origin:', file.origin)
    //     console.log('fileFilePond:', FilePond.FileOrigin.INPUT)

    //     let formData = new FormData();
    //     formData.append('filepond', file.file, file.file.name);

    //     @if($action == 'update')
    //         formData.append('id', '{{ $detail->id ?? 0 }}');
    //     @endif

    //     fetch('{{ route("course.add_image") }}', {
    //         method: 'POST',
    //         headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    //         body: formData
    //     })
    //     .then(res => res.json())
    //     .then(data => {
    //         if (data.success) {
    //             file.setMetadata('serverId', data.id);
    //         }
    //     });
    // });



    // Cập nhật thứ tự file vào input ẩn
    function updateOrder() {
        const order = pond.getFiles().map(f => f.file.name);
        document.getElementById('albumOrder').value = JSON.stringify(order);
    }

    pond.on('addfile', updateOrder);
    pond.on('addfile', updateFiles);
    pond.on('removefile', updateOrder);
    pond.on('reorderfiles', updateOrder);

    updateOrder();

    function updateFiles() {
        const hiddenInput = document.getElementById('albumOrder');
        const fileNames = pond.getFiles().map(f => f.file.name);
        hiddenInput.value = JSON.stringify(fileNames);
    }

    @if( $action == 'update' )
        pond.on('removefile', (error, fileItem) => {
            if (error) return;

            // Chỉ xử lý file đã preload (remote)
            if (fileItem.serverId || fileItem.source) {
                const fileUrl = fileItem.source; // URL ảnh

                // Gọi AJAX lên server để xóa
                fetch('{{ route("course.delete_image") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ url: fileUrl, id: '{{ $detail->id }}' })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success){
                        console.log('Deleted:', fileUrl);
                    } else {
                        console.warn('Xóa thất bại:', fileUrl);
                    }
                })
                .catch(err => console.error(err));
            }
        });

        // const uploadedImages = JSON.parse('<?php echo $detail->image_json ?>');
        // // Chuyển mảng URL thành định dạng FilePond
        // pond.files = uploadedImages.map(url => ({
        //     source: url,
        //     options: {
        //         type: 'remote' // remote để load từ URL
        //     }
        // }));

        // Nút upload
        $('#uploadBtn').click(function () {
            // Lấy tất cả file đang chọn trong FilePond
            const files = pond.getFiles();

            if (files.length === 0) {
                alert("Chưa chọn file nào!");
                return;
            }

            let formData = new FormData();
            files.forEach(f => {
                formData.append('filepond[]', f.file, f.file.name);
            });

            @if($action == 'update')
                formData.append('id', '{{ $detail->id ?? 0 }}');
            @endif

            fetch('{{ route("course.add_image") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    console.log("Upload thành công:", data);
                    // Nếu bạn muốn gán metadata cho từng file
                    files.forEach((f, index) => {
                        f.setMetadata('serverId', data.ids ? data.ids[index] : data.id);
                    });
                } else {
                    console.error("Upload lỗi:", data.error);
                }
            });
        });

    @endif
   
});
</script>
@endpush




@push('css')
<link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.min.css">
<link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css">
<link rel="stylesheet" href="https://unpkg.com/filepond-plugin-file-reorder/dist/filepond-plugin-file-reorder.min.css">

<style>
ul.filepond--list {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 15px;
}
</style>
@endpush
