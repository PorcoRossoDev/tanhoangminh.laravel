<div class="box p-5 mt-3 pt-3">
    <label class="form-label text-base font-semibold">Bài viết nổi bật (Dành cho slide trang chủ)</label>
    <select name="article_highlight[]" id="article-highlight" multiple placeholder="Nhập từ 3 ký tự để tìm kiếm..." class="form-control tom-select-add w-full" multiple data-max="2">
        @if($articleHighlight && $articleHighlight->isNotEmpty())
            @foreach ($articleHighlight as $item)
                <option value="{{ $item['value'] }}" selected>{{ $item['text'] }}</option>
            @endforeach
        @endif
    </select>
</div>

<div class="box p-5 mt-3 pt-3">
    <label class="form-label text-base font-semibold">Top comment (Dành cho slide trang chủ)</label>
    <select name="comment_highlight[]" id="comment-highlight" multiple placeholder="Nhập từ 3 ký tự để tìm kiếm..." class="form-control tom-select-add w-full" multiple data-max="2">
        @if($commentHighlight && $commentHighlight->isNotEmpty())
            @foreach ($commentHighlight as $item)
                <option value="{{ $item['value'] }}" selected>{{ $item['text'] }}</option>
            @endforeach
        @endif
    </select>
</div>

@push('javascript')
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    // let routeTomSelect = "{{ route('articles.search') }}"
    //     new TomSelect("#article-highlight", {
    //     valueField: "value", // dùng key "value"
    //     labelField: "text",  // dùng key "text"
    //     searchField: "text",
    //     loadThrottle: 500,
    //     shouldLoad: function(query) {
    //         return query.length >= 2;
    //     },
    //     load: function(query, callback) {
    //         let params = new URLSearchParams({ q: query });
    //         fetch(routeTomSelect + "?" + params.toString())
    //             .then(res => res.json())
    //             .then(json => {
    //                 callback(json);
    //             })
    //             .catch(() => {
    //                 callback();
    //             });
    //     }
    // });


    // Hàm khởi tạo chung cho TomSelect
    function initTomSelect(selector, routeUrl) {
        new TomSelect(selector, {
            valueField: "value",
            labelField: "text",
            searchField: "text",
            loadThrottle: 500,
            shouldLoad: function(query) {
                return query.length >= 2;
            },
            load: function(query, callback) {
                let params = new URLSearchParams({ q: query });
                fetch(routeUrl + "?" + params.toString())
                    .then(res => res.json())
                    .then(json => {
                        callback(json);
                    })
                    .catch(() => {
                        callback();
                    });
            }
        });
    }

    // Khởi tạo nhiều TomSelect
    let routeArticle = "{{ route('articles.search') }}";
    let routeComment = "{{ route('comments.getComment') }}";

    initTomSelect("#article-highlight", routeArticle);
    initTomSelect("#comment-highlight", routeComment);

</script>
@endpush


@push('css')
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

    .ts-hidden-accessible {
        display: none !important;
    }
    .ts-control > input {
        width: 100%;
        font-size: 14px;
        top: 3px;
        position: relative;
    }

    .ts-control > * {
    vertical-align: baseline;
    display: inline-block;
}

.ts-wrapper.multi .ts-control > div {
    cursor: pointer;
    margin: 0 3px 3px 0;
    padding: 2px 6px;
    background: #f2f2f2;
    color: #303030;
    border: 0 solid #d0d0d0;
}

.ts-control > input {
    flex: 1 1 auto;
    min-width: 7rem;
    display: inline-block !important;
    padding: 0 !important;
    min-height: 0 !important;
    max-height: none !important;
    max-width: 100% !important;
    margin: 0 !important;
    text-indent: 0 !important;
    border: 0 none !important;
    background: none !important;
    line-height: inherit !important;
    -webkit-user-select: auto !important;
    -moz-user-select: auto !important;
    -ms-user-select: auto !important;
    user-select: auto !important;
    box-shadow: none !important;
}

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
    transition-timing-function: 
cubic-bezier(0.4, 0, 0.2, 1);
    height: 42px;
}

.tom-select-add .ts-control {
    border: 1px solid #d0d0d0;
    padding: 8px 8px;
    width: 100%;
    overflow: hidden;
    position: relative;
    z-index: 1;
    box-sizing: border-box;
    box-shadow: none;
    border-radius: 3px;
    display: flex;
    flex-wrap: wrap;
    height: auto;
}

</style>
@endpush