@extends('dashboard.layout.dashboard')

@section('title')
<title>Cấu hình hệ thống</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Cấu hình",
        "src" => route('generals.index'),
    ],
    [
        "title" => "Cấu hình hệ thống",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<div class="content">
    <h1 class=" text-lg font-medium mt-10 mb-5">
        Cấu hình hệ thống
    </h1>

    <form method="post" action="{{route('generals.store')}}" class="form-horizontal box">
        @csrf
        <div class="grid">
            <!-- BEGIN: Basic Tab -->
            <div id="basic-tab" class="p-5">
                <div class="preview">
                    <ul class="nav nav-link-tabs flex-wrap" role="tablist">
                        <?php if (isset($tab) && is_array($tab) && count($tab)) { ?>
                            <?php $i = 0;
                            foreach ($tab as $key => $val) {
                                $i++; ?>

                                <li id="example-<?php echo $key ?>-tab" class="nav-item flex-1" role="presentation">
                                    <button class="nav-link w-full py-2 <?php if ($i == 1) { ?>active<?php } ?>" data-tw-toggle="pill" data-tw-target="#example-tab-<?php echo $key ?>" type="button" role="tab" aria-controls="example-tab-<?php echo $key ?>" aria-selected="true"><?php echo $val['label']; ?></button>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                    <div class="tab-content ">
                        <?php if (isset($tab) && is_array($tab) && count($tab)) { ?>
                            <?php $i = 0;
                            foreach ($tab as $key => $val) {
                                $i++; ?>
                                <div id="example-tab-<?php echo $key ?>" class="tab-pane leading-relaxed p-5 <?php if ($i == 1) { ?>active<?php } ?>" role="tabpanel" aria-labelledby="example-<?php echo $key ?>-tab">

                                    <div class="grid grid-cols-12 gap-6 mt-5">
                                        <div class=" col-span-12 lg:col-span-4">
                                            <h2 class="text-lg font-semibold leading-none mb-3">
                                                <?php echo $val['label']; ?></h2>
                                            <div class="">
                                                <?php echo $val['description']; ?>
                                            </div>
                                        </div>
                                        <div class=" col-span-12 lg:col-span-8">
                                            <?php if (isset($val['value']) && is_array($val['value']) && count($val['value'])) { ?>
                                                <div class="ibox m0">
                                                    <div class="ibox-content">
                                                        <?php foreach ($val['value'] as $keyItem => $valItem) { ?>
                                                            <?php $image = !empty($systems[$key . '_' . $keyItem]) ? asset($systems[$key . '_' . $keyItem]) : ''; ?>

                                                            <div class="mb-4">
                                                                <div class="flex justify-between">
                                                                    <label class="font-extrabold">
                                                                        <span><?php echo $valItem['label']; ?><?php echo (isset($valItem['title'])) ? '<a target="_blank" style="font-weight:normal;text-decoration:underline;font-size:12px;font-style:italic;" href="' . $valItem['link'] . '" title="">(' . $valItem['title'] . ')</a>' : ''; ?></span>
                                                                    </label>
                                                                    <?php if (isset($valItem['id'])) { ?>
                                                                        <span style="color:#9fafba;">
                                                                            <span id="<?php echo $valItem['id']; ?>"><?php echo strlen(slug(isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '')) ?></span>
                                                                            <?php echo (isset($valItem['extend'])) ? $valItem['extend'] : ''; ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php
                                                                if ($valItem['type'] == 'text') {
                                                                    echo Form::text('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control ' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '']);
                                                                } else if ($valItem['type'] == 'textarea') {
                                                                    echo Form::textarea('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control ' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '']);
                                                                } else if ($valItem['type'] == 'images') {
                                                                    echo '<div class="flex items-center">
                                                                    <img src="' . $image . '" style="width: 200px;height: 80px;object-fit: contain;">';
                                                                    echo Form::text('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control 1' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '', 'onclick' => "openKCFinder($(this), 'image')", 'style' => 'flex: 1;margin-left:10px']);
                                                                    echo "</div>";
                                                                } else if ($valItem['type'] == 'files') {
                                                                    echo Form::text('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control 1' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '', 'onclick' => "openKCFinder($(this), 'files')"]);
                                                                } else if ($valItem['type'] == 'media') {
                                                                    echo Form::text('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control 1' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '', 'onclick' => "openKCFinder($(this), 'media')"]);
                                                                } else if ($valItem['type'] == 'editor') {
                                                                    echo Form::textarea('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? htmlspecialchars_decode($systems[$key . '_' . $keyItem]) : '', ['id' => '' . $key . '_' . $keyItem . '', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']);
                                                                } else if ($valItem['type'] == 'dropdown') {
                                                                    echo Form::select('config[' . $key . '_' . $keyItem . ']', $valItem['value'], isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control', 'style' => 'width: 100%;']);
                                                                } else if ($valItem['type'] == 'select2') {
                                                                    $ids = !empty($systems[$key . '_' . $keyItem]) ? json_decode($systems[$key . '_' . $keyItem], true) : [];
                                                                    $data = getOptionTomSelect($valItem['module'], $ids);
                                                                    ?>
                                                                    <select name="<?php echo 'config[' . $key . '_' . $keyItem . '][]' ?>" multiple data-max="<?php echo $valItem['number'] ?>" class="w-full tom-select" data-module="<?php echo $valItem['module'] ?>" id="<?php echo 'config[' . $key . '_' . $keyItem . ']' ?>" placeholder="Nhập từ 3 ký tự để tìm kiếm...">
                                                                        @if($data && $data->IsNotEmpty())
                                                                        @foreach ($data as $k => $item)
                                                                            <option value="{{ $item['value'] }}" selected>{{ $item['text'] }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>


                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="text-right pr-5 pb-5">
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </div>

                </div>

            </div>

            <!-- END: Basic Tab -->
    </form>

</div>
</div>
@endsection

@push('javascript')
<script src="{{ asset('backend/js/jquery-2.2.2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    let routeTomSelect = "{{ route('generals.system.select2') }}"
    document.querySelectorAll('.tom-select').forEach(el => {
        const module = el.getAttribute('data-module'); // lấy data-module
        const maxItem = el.getAttribute('data-max'); // lấy data-module
        new TomSelect(el, {
            valueField: "value",
            labelField: "text",
            searchField: "text",
            maxItems: maxItem,
            shouldLoad: query => query.length >= 3,
            loadThrottle: 500,
            load: function(query, callback) {
                let params = new URLSearchParams({ 
                    q: query,
                    module: module // thêm param module vào URL
                });
                fetch(routeTomSelect + "?" + params.toString())
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
    });

</script>

@endpush

@push('css')
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