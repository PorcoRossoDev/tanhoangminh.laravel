@push('javascript')
    <script src="{{ asset('backend/js/jquery-2.2.2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    {{-- Đặt ngày tháng --}}
    <script>
        // Thông tin ngày tháng
        document.addEventListener('DOMContentLoaded', function() {
            // expiration_time picker
            const expirationPicker = flatpickr("#expiration_time", {
                dateFormat: "d-m-Y",
                onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length) instance.close(); // đóng khi chọn xong
                }
            });

            // registration_time picker
            const registrationPicker = flatpickr("#registration_time", {
                dateFormat: "d-m-Y",
                onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length) {
                    // expiration phải >= registration
                    expirationPicker.set("minDate", selectedDates[0]);
                    instance.close(); // đóng popup khi chọn xong
                }
                }
            });
        });
    </script>


    {{-- Tìm kiếm khách hàng --}}
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     ajaxTom('#customer_id', '<?php echo route("course_registrations.search_customer") ?>') // Tìm kiếm khách hàng
        //     ajaxTom('#course_id', '<?php echo route("course_registrations.search_course") ?>') // Tìm kiếm khóa học

        //     function ajaxTom(id, route){
        //         new TomSelect(id, {
        //             valueField: "value",   // id
        //             labelField: "text",    // hiển thị
        //             searchField: "text",   // cho phép search theo text
        //             shouldLoad: query => query.length >= 3,
        //             loadThrottle: 500,
        //             load: function(query, callback) {
        //                 fetch(route + "?q=" + encodeURIComponent(query))
        //                     .then(res => res.json())
        //                     .then(json => {
        //                         console.log("API trả về:", json);
        //                         // Nếu json không phải array thực sự thì convert
        //                         if (!Array.isArray(json)) {
        //                             json = Object.values(json);
        //                         }
        //                         callback(json);
        //                     })
        //                     .catch(() => {
        //                         callback(); // trả về rỗng khi lỗi
        //                     });
        //             }
        //         });
        //     }
        // });
        
    </script>

    <script>
        function ajaxTom(id, route, extraData = () => ({})) {
            return new TomSelect(id, {
                valueField: "value",
                labelField: "text",
                searchField: "text",
                shouldLoad: query => query.length >= 3,
                loadThrottle: 500,
                load: function(query, callback) {
                    let params = new URLSearchParams({ q: query, ...extraData() });
                    fetch(route + "?" + params.toString())
                        .then(res => res.json())
                        .then(json => {
                            if (!Array.isArray(json)) {
                                json = Object.values(json);
                            }
                            callback(json);
                        })
                        .catch(() => {
                            callback();
                        });
                }
            });
        }

        // Tạo select customer
        let customerSelect = ajaxTom(
            "#customer_id",
            "<?php echo route('course_registrations.search_customer') ?>"
        );

        // Tạo select course, ban đầu disable
        let courseSelect = ajaxTom(
            "#course_id",
            "<?php echo route('course_registrations.search_course') ?>",
            () => ({ customer_id: customerSelect.getValue() }) // gửi thêm customer_id
        );
        courseSelect.disable(); // ban đầu khóa lại

        // Khi chọn customer thì mở khóa course
        customerSelect.on("change", function(value) {
            if (value) {
                courseSelect.enable();
                courseSelect.clear(); // clear value cũ
            } else {
                courseSelect.disable();
                courseSelect.clear();
            }
        });

    </script>

    <script>
        $('#customer_id').change(function(){
            var customerID = $(this).val()
            if( customerID ){
                $('#course_id').attr('disabled', false)
            } else {
                $('#course_id').attr('disabled', true)
            }
        })
    </script>
@endpush


@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<style>
    .ts-control {
        width: 100%;
        border-radius: 0.375rem;
        --tw-border-opacity: 1;
        border-color: rgb(var(--color-slate-200) / var(--tw-border-opacity));
        font-size: 0.875rem;
        line-height: 1.25rem;
        --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        transition-property: color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
        transition-duration: 200ms;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        height: 42px;
    }
    .ts-control {
        align-items: center;
    }
    /* Wrapper khi disabled */
    .ts-wrapper.disabled .ts-control {
        background-color: #f9fafb;   /* nền xám nhạt */
        border: 1px solid #454545;  /* viền xám (Tailwind gray-300) */
        color: #7b7b7b;              /* chữ xám (Tailwind gray-400) */
        cursor: not-allowed;         /* chuột báo cấm */
        opacity: 0.7;
        box-shadow: none;            /* bỏ shadow nếu có */
    }

    /* Placeholder hoặc text mờ hơn */
    .ts-wrapper.disabled .ts-control .item,
    .ts-wrapper.disabled .ts-control input {
        color: #797979 !important;   /* chữ xám */
    }

    /* Nếu muốn bo tròn mềm mại */
    .ts-wrapper.disabled .ts-control {
        border-radius: 0.5rem; /* 8px */
    }

</style>
@endpush