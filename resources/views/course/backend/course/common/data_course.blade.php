
@php
    $type = old('type', $detail->type ?? null);
@endphp

<div id="groups-wrapper" class="space-y-4"></div>

<select name="type" id="type" class="form-control">
  <option value="">Chọn loại video</option>
  <option value="youtube" @if($type == 'youtube') selected @endif>Youtube</option>
  <option value="vimeo" @if($type == 'vimeo') selected @endif>Vimeo</option>
</select>

<div class="hidden" id="buttonAddGroup">
  <div class="flex gap-3">
    <button type="button" id="addGroupBtn" class="bg-primary bg-transparent px-4 py-2 rounded text-white mt-3 mb-3">
      + Thêm Group
    </button>
  </div>
</div>

{{-- Template Group --}}
<template id="group-template">
    <div class="group py-4 rounded bg-white">
      <div class="flex justify-between items-center">
        <h2 class="flex items-center">
            <span class="text-base font-medium inline-block whitespace-nowrap">Phần <span class="group-index">0</span></span>:
            <input type="text" class="border group-name outline-none p-2 rounded text-sm w-full ml-2" placeholder="Nhập tên group">
            <input type="hidden" class="group-type" placeholder="Nhóm group" value="">
        </h2>
        <div class="flex gap-2">
          <button type="button" class="toggle-blocks text-sm bg-transparent py-2 px-4 border rounded">Ẩn/Hiện</button>
          <button type="button" class="add-block text-sm py-2 px-4 border rounded">+ Khối</button>
          <button type="button" class="remove-group text-sm border py-2 px-4 rounded">Xóa</button>
        </div>
      </div>

      <div class="mt-3 hidden">
        <label class="block text-sm mb-1">Nội dung Group</label>
        <input type="text" class="group-content w-full border p-2 rounded" placeholder="Mô tả / nội dung">
      </div>

      <div class="blocks grid grid-cols-12 gap-4 mt-3"></div>
    </div>
  </template>

  {{-- Template Block --}}
  <template id="block-template">
    <div class="block border p-3 rounded bg-gray-50 col-span-12 lg:col-span-4">
      <div class="">
        <div class="w-full">
          <label class=" text-sm mb-1 hidden">Tiêu đề</label>
          <input type="text" class="block-title w-full border p-2 rounded text-sm mb-1" placeholder="Tiêu đề">

          <label class=" text-sm mt-2 mb-1 hidden">Link</label>
          <input type="text" class="block-link w-full border p-2 rounded text-sm mb-1" placeholder="Video">

          <label class=" text-sm mt-2 mb-1 hidden">Mô tả</label>
          <textarea class="block-desc w-full border p-2 rounded text-sm mb-1" rows="3" placeholder="Mô tả"></textarea>
        </div>

        <div class="">
          <button type="button" class="bg-danger px-3 py-1 remove-block rounded text-white">Xóa</button>
        </div>
      </div>
    </div>
  </template>

@push('javascript')

<script>
  const type = document.getElementById('type');
  const btnAddgroup = document.getElementById('buttonAddGroup');

  // Hàm kiểm tra để ẩn/hiện
  function toggleButton() {
    if (type.value) {
      btnAddgroup.classList.remove("hidden");
    } else {
      btnAddgroup.classList.add("hidden");
    }
  }

  // Gọi 1 lần khi load
  toggleButton();

  // Gọi lại mỗi khi select thay đổi
  type.addEventListener("change", toggleButton);
</script>

<script>
    // Thêm group, block, re-index đảm bảo tên input đúng
    document.getElementById('addGroupBtn').addEventListener('click', addGroup);

    let uid = 0; // id duy nhất cho mỗi group (không dùng cho index gửi về Laravel)

    var videos = null
    @if( isset($videos) )
      videos = @json($videos)
    @endif

    function addGroup() {
      const tpl = document.getElementById('group-template');
      const clone = tpl.content.cloneNode(true);
      const groupEl = clone.querySelector('.group');

      // gán uid (không bắt buộc nhưng hữu ích)
      groupEl.dataset.uid = uid++;

      // gắn sự kiện trước khi append
      groupEl.querySelector('.add-block').addEventListener('click', () => addBlock(groupEl));
      groupEl.querySelector('.remove-group').addEventListener('click', () => {
        groupEl.remove();
        reIndexGroups();
      });
      groupEl.querySelector('.toggle-blocks').addEventListener('click', () => {
        groupEl.querySelector('.blocks').classList.toggle('hidden');
      });

      document.getElementById('groups-wrapper').appendChild(clone);
      reIndexGroups(); // quan trọng: cập nhật số thứ tự và name cho tất cả groups/blocks
    }

    function addBlock(groupEl) {
      const tpl = document.getElementById('block-template');
      const clone = tpl.content.cloneNode(true);
      const blockEl = clone.querySelector('.block');

      // gắn sự kiện xóa block
      blockEl.querySelector('.remove-block').addEventListener('click', () => {
        blockEl.remove();
        reIndexGroups();
      });

      groupEl.querySelector('.blocks').appendChild(blockEl); // append blockEl thay vì clone
      reIndexGroups();
      return blockEl; // ✅ trả ra block vừa tạo
    }

    function reIndexGroups() {
      // Duyệt tất cả group trên DOM và gán index + name input đúng
      document.querySelectorAll('.group').forEach((groupEl, gIndex) => {
        // hiển thị thứ tự
        const idxEl = groupEl.querySelector('.group-index');
        if (idxEl) idxEl.textContent = gIndex + 1;

        // gán name cho fields của group
        const nameInput = groupEl.querySelector('.group-name');
        const contentInput = groupEl.querySelector('.group-content');
        const typeInput = groupEl.querySelector('.group-type');
        if (nameInput) nameInput.name = `groups[${gIndex}][name]`;
        if (contentInput) contentInput.name = `groups[${gIndex}][content]`;
        if (typeInput) typeInput.name = `groups[${gIndex}][type]`;
        if (typeInput) typeInput.value = gIndex;

        // gán name cho mỗi block trong group
        groupEl.querySelectorAll('.block').forEach((blockEl, bIndex) => {
          const title = blockEl.querySelector('.block-title');
          const link  = blockEl.querySelector('.block-link');
          const desc  = blockEl.querySelector('.block-desc');

          if (title) title.name = `groups[${gIndex}][blocks][${bIndex}][title]`;
          if (link)  link.name  = `groups[${gIndex}][blocks][${bIndex}][link]`;
          if (desc)  desc.name  = `groups[${gIndex}][blocks][${bIndex}][description]`;
        });
      });
    }

    // Nếu bạn muốn render sẵn 1 group khi load (tuỳ chọn)
    // addGroup();


    function renderGroupsFromVideos(videos) {
        // Gom nhóm video theo title_group

        if(!videos) {
          return false
        }

        const groups = {};
        videos.forEach(video => {
            if (!groups[video.title_group]) {
                groups[video.title_group] = [];
            }
            groups[video.title_group].push(video);
        });

        // Duyệt từng group
        Object.entries(groups).forEach(([title_group, items], gIndex) => {
            // Tạo group mới
            addGroup();
            const groupEl = document.querySelectorAll('.group')[gIndex];

            // Gán tên group
            const nameInput = groupEl.querySelector('.group-name');
            nameInput.value = title_group;

            // Nếu muốn gán type_group (từ video đầu tiên)
            const typeInput = groupEl.querySelector('.group-type');
            typeInput.value = items[0].type_group;

            // Render blocks
            items.forEach(video => {
            const blockEl = addBlock(groupEl); // giờ nhận blockEl trực tiếp

            if (blockEl) {
                const titleInput = blockEl.querySelector('.block-title');
                const linkInput  = blockEl.querySelector('.block-link');
                const descInput  = blockEl.querySelector('.block-desc');

                if (titleInput) titleInput.value = video.name || '';
                if (linkInput)  linkInput.value  = video.link || '';
                if (descInput)  descInput.value  = video.description || '';
            }
            });
        });

        reIndexGroups();
    }

    document.addEventListener('DOMContentLoaded', () => {
    renderGroupsFromVideos(videos);
    });

  </script>
@endpush

@push('css')
<style>
    #groups-wrapper > div {
        border-top: 2.5px solid green;
    }
</style>
@endpush