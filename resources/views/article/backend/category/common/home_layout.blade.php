<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
     style="background: rgba(0,0,0,.7);display:none">
    <div class="bg-white border border-teal-500 mx-auto overflow-y-auto rounded shadow-lg w-1/2">
        <div class="modal-content py-4 text-left px-6">
            <form action="{{ route('category_articles.update_view') }}" id="updateView">
                <div class="flex justify-between items-center pb-3">
                    <p class="md:text-2xl font-bold">Giao diện ngoài trang chủ</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                             viewBox="0 0 18 18">
                            <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>
                @csrf
                <div class="my-5 grid grid-cols-12 gap-x-6 gap-y-4">
                    <div class="item w-full col-span-12 lg:col-span-4 text-center">
                        <label for="value_0">
                            <img src="{{asset('backend/images/view/Screenshot_1.png')}}" alt="" style="height: 150px;object-fit: cover;">
                        </label>
                        <input type="radio" id="value_0" name="view_update" value="0" class="mt-3">
                    </div>
                    <div class="item w-full col-span-12 lg:col-span-4 text-center">
                        <label for="value_1">
                            <img src="{{asset('backend/images/view/Screenshot_2.png')}}" alt="" style="height: 150px;object-fit: cover;">
                        </label>
                        <input type="radio" id="value_1" name="view_update" value="1" class="mt-3">
                    </div>
                    <div class="item w-full col-span-12 lg:col-span-4 text-center">
                        <label for="value_2">
                            <img src="{{asset('backend/images/view/Screenshot_3.png')}}" alt="" style="height: 150px;object-fit: cover;">
                        </label>
                        <input type="radio" id="value_2" name="view_update" value="2" class="mt-3">
                    </div>
                </div>
                <input type="hidden" name="cat_id" value="">
                <input type="hidden" name="view_name" value="view_home">
                <div class="flex justify-center pt-2">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('css')
    <link href="{{asset('library/toastr/toastr.min.css')}}" rel="stylesheet">
@endpush

@push('javascript')
    <script src="{{asset('library/toastr/toastr.min.js')}}"></script>
    <script>
        const modal = document.querySelector('.main-modal');
        const closeButton = document.querySelectorAll('.modal-close');

        const modalClose = () => {
            modal.classList.remove('fadeIn');
            modal.classList.add('fadeOut');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 500);
        }

        const openModal = () => {
            modal.classList.remove('fadeOut');
            modal.classList.add('fadeIn');
            modal.style.display = 'flex';
        }

        for (let i = 0; i < closeButton.length; i++) {
            const elements = closeButton[i];
            elements.onclick = (e) => modalClose();
            modal.style.display = 'none';
            window.onclick = function (event) {
                if (event.target == modal) modalClose();
            }
        }

        $('.publish-ajax').change(function () {
            let module = $(this).attr('data-title')
            let view = $(this).attr('data-view-home');
            let id = $(this).attr('data-id');
            if( module == 'ishome' && $(this).prop('checked') == true ) {
                modal.classList.remove('fadeOut');
                modal.classList.add('fadeIn');
                modal.style.display = 'flex';

                $('input[name="view_update"][value="'+view+'"]').prop('checked', true)
                $('input[name="cat_id"]').val(id)
            }
        })

        $('#updateView').submit(function () {
            let url = $(this).attr('action');
            let data = $(this).serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (json) {
                    toastr.success('Cập nhật thành công!', 'Thành công!')
                    modalClose()
                    setTimeout(function () {
                        //window.location.reload()
                    }, 1000)
                },
                error: function(err) {
                    toastr.error('Xin vui lòng thử lại', 'Lỗi')
                }
            })
            return false;
        })
    </script>
@endpush