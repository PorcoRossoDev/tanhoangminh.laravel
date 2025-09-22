@if(isset($comments) && $comments->isNotEmpty())
    @foreach($comments as $comment)
        <div class="item flex gap-[20px] mb-[40px]">
            <div class="w-[50px] h-[50px]">
                <img src="{{ $comment->avatar ?? 'upload/images/logo/author.jpg' }}" class="w-full h-full rounded-full" alt="">
            </div>
            <div class="flex-1 bg-[#FFF6E4] px-[20px] py-[10px] rounded-[10px]">
                <div class="flex justify-between">
                    <div class="text-f16 font-medium leading-[160%]">{{ $comment->fullname ?? 'anonymous' }}</div>
                    <div class="text-[#9397AD] text-f14">{{ $comment->created_at->format('M d, Y') }}</div>
                </div>
                <div class="mt-[20px]">
                    {{ $comment->message }}
                </div>
                <div class="flex items-center justify-end">
                    <button type="button" class="btn-like flex items-center justify-end {{ $comment->likes->isNotEmpty() ? 'like-active' : '' }}" data-id="{{ $comment->id }}" data-likes="{{ $comment->likes_count ?? 0 }}">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 5H9.791L10.6332 2.47475C10.7847 2.01875 10.7083 1.51325 10.427 1.12325C10.1458 0.73325 9.68975 0.5 9.209 0.5H8C7.77725 0.5 7.5665 0.599 7.42325 0.77L3.89825 5H2C1.17275 5 0.5 5.67275 0.5 6.5V13.25C0.5 14.0773 1.17275 14.75 2 14.75H4.25H11.9802C12.602 14.75 13.166 14.3593 13.385 13.7765L15.4528 8.26325C15.4843 8.17925 15.5 8.09 15.5 8V6.5C15.5 5.67275 14.8273 5 14 5ZM2 6.5H3.5V13.25H2V6.5ZM14 7.86425L11.9802 13.25H5V6.0215L8.351 2H9.2105L8.039 5.51225C7.96175 5.741 8.00075 5.99225 8.14175 6.188C8.28275 6.3845 8.50925 6.5 8.75 6.5H14V7.86425Z" fill="#9397AD"/>
                        </svg>
                        <span class="inline-block ml-1 text-[#9397AD] relative top-[1px] totalLikes">{{ $comment->likes_count ?? 0 }}</span>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
    <div id="pagination" class="mt-4 pagenavi">{!! $comments->links() !!}</div>
@endif