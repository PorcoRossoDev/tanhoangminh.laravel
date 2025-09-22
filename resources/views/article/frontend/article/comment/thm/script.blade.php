@push('javascript')

    {{-- Like comment --}}
    <script>
        $(document).on('click', '.btn-like', function(e) {
            e.preventDefault();
            let btn = $(this);
            let commentId = btn.data('id');
        
            $.ajax({
                url: "comment/articles/comment/like/" + commentId,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content")
                },
                success: function(res) {
                    btn.find('.totalLikes').text(res.totalLikes);
                    if (res.status === "liked") {
                        btn.addClass("like-active"); // đổi màu nút khi đã like
                    } else {
                        btn.removeClass("like-active");
                    }                    
                },
                error: function(err) {
                    if (err.status === 401) {
                        alert("Vui lòng đăng nhập để like!");
                    }
                }
            });
        });
    </script>

    {{-- Load comment & phân trang --}}
    <script>
        $(document).ready(function() {
            // Bắt sự kiện click phân trang
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchComments(page);
            });
        
            fetchComments(1)
            function fetchComments(page) {
                $.ajax({
                    url: "{{ route('commentFrontend.listComment') }}" + "?page=" + page,
                    data:{
                        id: '<?php echo $detail->id ?>'
                    },
                    success: function(data) {
                        $('#comment-list').html(data);
                    },
                    error: function() {
                        alert("Không tải được dữ liệu");
                    }
                });
            }
        });
    </script>

    {{-- Post comment --}}
    <script>
        $('#postArticle').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "<?php echo route('commentFrontend.postArticle') ?>",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                data: {
                    comment: $('#postArea').val(),
                    module_id: '<?php echo $detail->id ?>'
                },
                success: function(data) {
                    if (data.status == 200) {
                        $("#form-comment .print-error-msg").css('display', 'none');
                        $("#form-comment .print-success-msg").css('display', 'flex');
                        $("#form-comment .print-success-msg span").html("<?php echo $fcSystem['message_3'] ?>");
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        $("#form-comment .print-error-msg").css('display', 'flex');
                        $("#form-comment .print-success-msg").css('display', 'none');
                        $("#form-comment .print-error-msg span").html(data.error);
                    }
                }
            });
        });
    </script>
@endpush

@push('css')
<style>
    .like-active svg path {
        fill: #c38e2b;
    }

    .like-active span {
        color: #c38e2b;
    }
</style>
@endpush