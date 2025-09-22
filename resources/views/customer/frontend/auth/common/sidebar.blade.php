<div class="bg-white p-3 border-t-[3px] border-[#000]">
    <section class="flex items-center mb-1">
        <div class="border rounded-full h-[50px] w-[50px] overflow-hidden">
            <img src="https://ui-avatars.com/api/?name={{Auth::guard('customer')->user()->name}}" alt="{{Auth::guard('customer')->user()->name}}" class="blur-up h-full w-full t-img">
        </div>
        <div class="flex flex-col ml-3">
            <span class="font-extrabold text-[18px]">
                {{Auth::guard('customer')->user()->name}}
            </span>
            <a href="javascript:void(0)" class="font-bold  text-blue-500">
                <?php /*Số dư: {{number_format(Auth::guard('customer')->user()->phone,'0',',','.')}}₫*/ ?>
                {{Auth::guard('customer')->user()->phone}}
            </a>
        </div>
    </section>
    <div class="h-px mt-3 bg-slate-200"></div>
    <div class="flex flex-col gap-3">
        <a href="{{route('customer.dashboard')}}" class="menu_item_auth flex justify-between items-center p-3 rounded-xl ">
            <div class="flex space-x-2 items-center">
                <svg class="svg-inline--fa fa-user fa-w-14 margin-r-5 w-5 h-5" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg>
                <span>{{trans('index.AccountInformation')}}</span>
            </div>
        </a>
        <a href="{{route('customer.address')}}" class="menu_item_auth flex justify-between items-center p-3 rounded-xl hidden">
            <div class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-global" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
                <span>{{trans('index.ContactInformation')}}</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>
        <a href="{{route('customer.orders')}}" class="menu_item_auth flex justify-between items-center p-3 rounded-xl hidden">
            <div class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-global" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span>{{trans('index.PurchaseHistory')}}</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>
        <a href="tel:{{$fcSystem['contact_hotline']}}" class="flex justify-between items-center p-3 hover:bg-gray-100 hover:rounded-xl hidden">
            <div class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-global" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <span>{{trans('index.CallHotline')}} {{$fcSystem['contact_hotline']}}</span>
            </div>
        </a>
    </div>
    <a href="{{route('customer.logout')}}" class="flex justify-between items-center p-3 hover:bg-gray-100 hover:rounded-xl">
        <div class="flex space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            <span>{{trans('index.Logout')}}</span>
        </div>
    </a>
</div>
<script>
    var aurl = window.location.href; // Get the absolute url
    $('.menu_item_auth').filter(function() {
        return $(this).prop('href') === aurl;
    }).addClass('active');
</script>
<style>
</style>