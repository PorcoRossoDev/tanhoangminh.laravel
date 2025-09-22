<?php

if (!function_exists('svl_ismobile')) {

    function svl_ismobile()
    {
        $tablet_browser = 0;
        $mobile_browser = 0;

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
        );

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }

        if ($tablet_browser > 0) {
            // do something for tablet devices
            return 'is tablet';
        } else if ($mobile_browser > 0) {
            // do something for mobile devices
            return 'is mobile';
        } else {
            // do something for everything else
            return 'is desktop';
        }
    }
}
if (!function_exists('getImageUrl')) {
    function getImageUrl($module = '', $src = '', $type = '')
    {
        $path  = '';
        $dir = explode("/", $src);
        $file = collect($dir)->last();
        if (svl_ismobile() == 'is mobile') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else if (svl_ismobile() == 'is tablet') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else if (svl_ismobile() == 'is desktop') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else {
            $path = $src;
        }
        if (File::exists(base_path($path))) {
            $path = $path;
        } else {
            $path = $src;
        }
        return asset($path);
    }
}
if (!function_exists('getFunctions')) {
    function getFunctions()
    {
        $data = [];
        $getFunctions = \App\Models\Permission::select('title')->where('publish', 0)->where('parent_id', 0)->get()->pluck('title');
        if (!$getFunctions->isEmpty()) {

            foreach ($getFunctions as $v) {
                $data[] = $v;
            }
        }
        return $data;
    }
}
if (!function_exists('getUrlHome')) {
    function getUrlHome()
    {
        return !empty(config('app.locale') == 'vi') ? url('/') : url('/en');
    }
}
/**HTML: Breadcrumb */
if (!function_exists('htmlBreadcrumb')) {
    function htmlBreadcrumb($title = '', $breadcrumb = [])
    {
        $html = '';
        $bg = getFcSystem('title_4');
        $html .= '<div class="page-hero-title wow fadeInUp">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li><a href="'.url('/').'">'.trans('index.home').'</a></li>';
                            if( isset($breadcrumb) && count($breadcrumb) ) {
                                foreach( $breadcrumb as $k => $v ) {
                                    $html .= '<li>
                                    <svg width="25px" height="25px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="icomoon-ignore"> </g> <path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" fill="#000000"> </path> </g></svg>                                    
                                    <a href="'.$v['url'].'">'.$v['title'].'</a>
                                    </li>';
                                }
                            } else {
                                $html .= '<li class="active">
                                <svg width="25px" height="25px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="icomoon-ignore"> </g> <path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" fill="#000000"> </path> </g></svg>                                    
                                '.$title.'</li>';
                            }
                            
                        $html .= '</ol>
                    </div>
                </div>';

        return $html;
    }
}


if (!function_exists('htmlArticle')) {
    function htmlArticle($item = [])
    {
        $html = '';
        $html .= '<div class="mb-[50px] px-[10px]">
             <div class=" h-full flex flex-col space-y-2">
                <div class="img hover-zoom flex-shrink-0 zoom-effect overflow-hidden">
                    <a href="' . route('routerURL', ['slug' => $item['slug']]) . '" class="relative">
                        <img src="' . asset($item['image']) . '" alt="' . $item['title'] . '" class="w-full object-cover md:h-[190px]" />
                    </a>
                </div>
                 <div class="flex-1 flex flex-col justify-between space-y-1.5">
                    <h3 class="title-2 text-f15 md:text-base font-black  clamp-3">
                        <a href="' . route('routerURL', ['slug' => $item['slug']]) . '" class="text-base leading-[1.1] transition-all hover:text-primary">' . $item['title'] . '</a>
                    </h3>
                    <div class="flex items-center text-sm text-[#999]">
                        <span class="flex items-center space-x-1">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>
                                ' . $item['created_at'] . '
                            </span>
                        </span>
                    </div>
                    <div class="clamp clamp-3 text-[#757575]">
                        ' . strip_tags($item['description']) . '
                    </div>
                    <div>
                        <a href="' . route('routerURL', ['slug' => $item['slug']]) . '" class="font-bold tracking-wider uppercase text-f13">Xem thêm ...</a>
                    </div>
                 </div>
             </div>
         </div>';
        return $html;
    }
}
if (!function_exists('htmlAddress')) {
    function htmlAddress($data = [])
    {
        $html = '';
        if (isset($data)) {
            foreach ($data as $k => $v) {
                $html .= ' <li class="showroom-item loc_link result-item" data-brand="' . $v->title . '"
    data-address="' . $v->address . '" data-phone="' . $v->hotline . '" data-lat="' . $v->lat . '"
    data-long="' . $v->long . '">
    <div class="heading" style="display: flex">

        <p class="name-label" style="flex: 1">
            <strong>' . ($k + 1) . '. ' . $v->title . '</strong>
        </p>
    </div>
    <div class="details">
        <p class="address" style="flex:1"><em>' . $v->address . '</em>
        </p>

        <p class="button-desktop button-view hidden-xs">
            <a href="javascript:void(0)" onclick="return false;">Tìm đường</a>
            <a class="arrow-right"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </p>
        <p class="button-mobile button-view visible-xs">
            <a target="_blank" href="https://www.google.com/maps/dir//' . $v->lat . ',' . $v->long . '">Tìm đường</a>
            <a class="arrow-right" target="_blank"
                href="https://www.google.com/maps/dir//' . $v->lat . ',' . $v->long . '"><span><i
                        class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </p>
    </div>
</li>';
            }
        }
        return $html;
    }
}

/**HTML: item sản phẩm */
if (!function_exists('htmlItemProduct')) {
    function htmlItemProduct( $item = [] )
    {
        //dd($item);
        $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'],TRUE) : NULL;
        $html = '';
        $id = $item['id'];
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>
        $item['price_contact']));
        $route = route('routerURL', ['slug' => $item['slug']]);
        $image = asset($item['image']);
        $title = $item['title'];
        $code = $item['code'];
        $listAlbums = htmlAlbum($item);
        $video = showField($item->fields, 'config_colums_input_product_video');
        $attr = getAttrItemProduct($item['type_attr']);

        if( !empty($wishlist) && in_array($id, $wishlist) ) {
            $svg = '<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>';
        } else {
            $svg = '<path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"></path>';
        }

        
        $html .= '<div class="border item rounded">
                    <div class="box-text text-center py-3.5">
                        <b class="block">'.$code.'</b>
                        <span class="block w-full h-[22px]" style="min-height:22px">'. ((isset($attr) && is_array($attr) && count($attr)) ? (trans('index.Type') .': ' . $attr['title']) : '') .'</span>
                    </div>
                    <div class="box-thumb p-1">
                        <img src="'.$image.'" class="rounded h-[300px] object-cover w-full change-image" alt="">
                        <div class="list-thumbs">
                            '.$listAlbums.'
                        </div>
                    </div>
                    <div class="box-action flex justify-between p-2">
                        <a type="button" data-href="'.$route.'" onclick="copyShare($(this))" class="text-center w-1/4 cursor-pointer">
                            <svg class="MuiSvgIcon-root bodytextcolor inline-block" focusable="false" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"></path></svg>
                            <span class="block">'.trans('index.Share').'</span>
                        </a>
                        <a type="button" class="text-center w-1/4 js_add_wishlist cursor-pointer" data-id="'.$id.'">
                            <svg class="MuiSvgIcon-root bodytextcolor inline-block" focusable="false" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">'.$svg.'</svg>                                
                            <span class="block">'.trans('index.Favorites').'</span>
                        </a>
                        <a href="'.$video.'" data-fancybox class="text-center w-1/4">
                            <svg class="MuiSvgIcon-root bodytextcolor inline-block" focusable="false" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4zM14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2z"></path></svg>
                            <span class="block">Video</span>
                        </a>
                        <a href="'.$route.'" class="text-center w-1/4">
                            <svg class="MuiSvgIcon-root bodytextcolor inline-block" focusable="false" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><path d="M7.52 21.48C4.25 19.94 1.91 16.76 1.55 13H.05C.56 19.16 5.71 24 12 24l.66-.03-3.81-3.81-1.33 1.32zm.89-6.52c-.19 0-.37-.03-.52-.08-.16-.06-.29-.13-.4-.24-.11-.1-.2-.22-.26-.37-.06-.14-.09-.3-.09-.47h-1.3c0 .36.07.68.21.95.14.27.33.5.56.69.24.18.51.32.82.41.3.1.62.15.96.15.37 0 .72-.05 1.03-.15.32-.1.6-.25.83-.44s.42-.43.55-.72c.13-.29.2-.61.2-.97 0-.19-.02-.38-.07-.56-.05-.18-.12-.35-.23-.51-.1-.16-.24-.3-.4-.43-.17-.13-.37-.23-.61-.31.2-.09.37-.2.52-.33.15-.13.27-.27.37-.42.1-.15.17-.3.22-.46.05-.16.07-.32.07-.48 0-.36-.06-.68-.18-.96-.12-.28-.29-.51-.51-.69-.2-.19-.47-.33-.77-.43C9.1 8.05 8.76 8 8.39 8c-.36 0-.69.05-1 .16-.3.11-.57.26-.79.45-.21.19-.38.41-.51.67-.12.26-.18.54-.18.85h1.3c0-.17.03-.32.09-.45s.14-.25.25-.34c.11-.09.23-.17.38-.22.15-.05.3-.08.48-.08.4 0 .7.1.89.31.19.2.29.49.29.86 0 .18-.03.34-.08.49-.05.15-.14.27-.25.37-.11.1-.25.18-.41.24-.16.06-.36.09-.58.09H7.5v1.03h.77c.22 0 .42.02.6.07s.33.13.45.23c.12.11.22.24.29.4.07.16.1.35.1.57 0 .41-.12.72-.35.93-.23.23-.55.33-.95.33zm8.55-5.92c-.32-.33-.7-.59-1.14-.77-.43-.18-.92-.27-1.46-.27H12v8h2.3c.55 0 1.06-.09 1.51-.27.45-.18.84-.43 1.16-.76.32-.33.57-.73.74-1.19.17-.47.26-.99.26-1.57v-.4c0-.58-.09-1.1-.26-1.57-.18-.47-.43-.87-.75-1.2zm-.39 3.16c0 .42-.05.79-.14 1.13-.1.33-.24.62-.43.85-.19.23-.43.41-.71.53-.29.12-.62.18-.99.18h-.91V9.12h.97c.72 0 1.27.23 1.64.69.38.46.57 1.12.57 1.99v.4zM12 0l-.66.03 3.81 3.81 1.33-1.33c3.27 1.55 5.61 4.72 5.96 8.48h1.5C23.44 4.84 18.29 0 12 0z"></path></svg>
                            <span class="block">'.trans('index.Designs').'</span>
                        </a>
                    </div>
                </div>';
        return $html;
    }
}

/**HTML: item sản phẩm bán kèm */
if (!function_exists('htmlAlbum')) {
    function htmlAlbum($item = [])
    {
        $html = '';
        if (!empty($item['image_json'])) {
            $listAlbums = json_decode($item['image_json'], true);
        } else {
            $listAlbums = [$item['image']];
        }

        $html .= '<ul class="pt-0.5 grid grid-cols-6 gap-0.5">';
        foreach( $listAlbums as $k => $v ) {
            if( $k < 6 ) {
                $html .= '<li class="px-0.5">
                            <a href="javascript:void(0)" class="load-img" data-img="'.asset($v).'">
                                <img src="'.asset($v).'" class="rounded h-50px object-cover w-full" alt="">
                            </a>
                        </li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
}

/**HTML: item sản phẩm bán kèm */
if (!function_exists('htmlItemProductUpSell')) {
    function htmlItemProductUpSell($item = [])
    {
        $html = '';
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' => $item['price_contact']));
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];

        $html .= '<div class="product-item text-center pd-2 mb-6" style="border-bottom: 1px solid #ddd">
                    <div class="box-image">
                        <a href="' . $href . '"><img src="' . $img . '" alt="' . $title . '" height="90" width="90" style="display: inline-block;object-fit: contain"></a>
                    </div>
                    <div class="box-text pt-2 pb-2">
                        <a href="' . $href . '">
                            <h4 class="title-product text-f15">
                                ' . $title . '
                            </h4>
                        </a>
                    </div>
                    <div class="box-price pb-2">
                        <span class="text-red extraPriceFinal text-f16 text-red-600 font-bold">' . $price['price_final'] . '</span>
                        <del class="ml-[5px] extraPriceOld text-f14">' . $price['price_old'] . '</del>
                    </div>
                    <div class="box-action pb-5">
                        <a href="javascript:void(0)" class="addToCartDeals text-f15 text-blue-700">+ Thêm vào giỏ</a>
                    </div>
                </div>';
        return $html;
    }
}

/**HTML: item tin tức */
if (!function_exists('htmlItemNews')) {
    function htmlItemNews($item = [], $classParent = 'md:w-1/2 lg:w-1/2', $classColL = 'lg:w-1/2', $classColR = 'lg:w-1/2')
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];

        $html .= '<div class="w-full '. $classParent .' px-[15px]">
                    <div class="lg:flex items-center my-4 box-shadow-custom px-3 py-3 group hover:transform hover:translate-y-[-10px] transition duration-300 ease-in-out"
                        style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="'. $classColL.' w-full img hover-zoom">
                            <a href="'.$href.'">
                                <img src="'.$img.'"
                                    class="h-260px object-cover w-full" alt="">
                            </a>
                        </div>
                        <div
                            class="'. $classColR.' w-full bg-white pl-3 bottom-0 last:border-00 text-black transition duration-300 ease-in-out">
                            <h3 class="border-b border-black my-3 pb-2"><a href="'.$href.'"
                                    class="font-medium leading-7 text-f18">'.$title.'</a></h3>
                            <p class="mb-2 text-f15"><i class="fas fa-calendar-alt"></i> '.getDateName($item->created_at).', '.date('h:m', strtotime($item->created_at)).' - '.date('d/m/Y', strtotime($item->created_at)).'</p>
                            <div class="mt-4 text-justify"
                                style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            display: -webkit-box;
                            text-align: justify;
                        ">'.$desc.'</div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

/**HTML: item dự án */
if (!function_exists('htmlItemProject')) {
    function htmlItemProject($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];

        $html .= '<div class="w-1/2 lg:w-1/2 xl:w-1/2 xl:px-[15px] px-[10px]">
                    <div class="item mt-3">
                        <div
                            class="group box-shadow-custom border border-gray-100 item mb-[10px] md:mb-[30px] relative shadow hover:transform hover:translate-y-[-10px] transition duration-300 ease-in-out">
                            <div class="img hover-zoom">
                                <a href="'.$href.'">
                                    <img src="'.$img.'"
                                        class="w-full h-175px md:h-500px lg:h-500px xl:h-500px object-cover" alt="">
                                </a>
                            </div>
                            <div
                                class=" bg-white bottom-0 duration-300 ease-in-out group-hover:bg-color_hover group-hover:text-white last:border-00 md:px-3 md:py-3 md:text-center pb-2 px-2 text-black transition">
                                <h3 class="my-3"><a href="'.$href.'" class="font-medium text-f18 text-left" style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    display: -webkit-box;
                                ">'.$title.'</a></h3>
                                <div
                                    class="xl:flex xl:flex-wrap justify-start mx-[-15px] mt-[15px] md:mt-[30px] items-center">
                                    <div class="w-full xl:w-3/4 px-[15px]">
                                        <div class="text-left"
                                            style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                    display: -webkit-box;
                                ">'.$desc.'</div>
                                    </div>
                                    <div
                                        class="mb-4 mt-5 px-[15px] md:text-center text-left w-full xl:mb-0 xl:mt-0 xl:text-right xl:w-1/4">
                                        <a href="'.$href.'"
                                            class="border border-black btn-readmore group-hover:border-white header-22 px-3 md:py-2 py-1.5 rounded-[30px]">Xem
                                            thêm <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemPostHome')) {
    function htmlItemPostHome($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = strip_tags($item['description']);
        $created = date('d-m-Y', strtotime($item['created_at']));
        $html .= '<div class="post-item">
                    <div class="post-item-info">
                        <div class="post-item-photo">
                            <a href="'.$href.'" class="post-image-container">
                                <img src="'.$img.'" alt="'.$title.'">
                            </a>
                        </div>
                        <div class="post-item-details">
                            <h3 class="post-item-title">
                                <a href="'.$href.'">'.$title.'</a>
                            </h3>
                            <div class="post-data">
                                <div class="post-item-excerpt">'.$desc.'</div>
                            </div>
                            <div class="post-item-actions">
                                <div class="date">
                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="#231F20" d="M11,54h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C10,53.553,10.447,54,11,54 z M12,49h4v3h-4V49z"></path> <path fill="#231F20" d="M23,54h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C22,53.553,22.447,54,23,54 z M24,49h4v3h-4V49z"></path> <path fill="#231F20" d="M35,54h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C34,53.553,34.447,54,35,54 z M36,49h4v3h-4V49z"></path> <path fill="#231F20" d="M11,43h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C10,42.553,10.447,43,11,43 z M12,38h4v3h-4V38z"></path> <path fill="#231F20" d="M23,43h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C22,42.553,22.447,43,23,43 z M24,38h4v3h-4V38z"></path> <path fill="#231F20" d="M35,43h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C34,42.553,34.447,43,35,43 z M36,38h4v3h-4V38z"></path> <path fill="#231F20" d="M47,43h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C46,42.553,46.447,43,47,43 z M48,38h4v3h-4V38z"></path> <path fill="#231F20" d="M11,32h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C10,31.553,10.447,32,11,32 z M12,27h4v3h-4V27z"></path> <path fill="#231F20" d="M23,32h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C22,31.553,22.447,32,23,32 z M24,27h4v3h-4V27z"></path> <path fill="#231F20" d="M35,32h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C34,31.553,34.447,32,35,32 z M36,27h4v3h-4V27z"></path> <path fill="#231F20" d="M47,32h6c0.553,0,1-0.447,1-1v-5c0-0.553-0.447-1-1-1h-6c-0.553,0-1,0.447-1,1v5C46,31.553,46.447,32,47,32 z M48,27h4v3h-4V27z"></path> <path fill="#231F20" d="M60,4h-7V3c0-1.657-1.343-3-3-3s-3,1.343-3,3v1H17V3c0-1.657-1.343-3-3-3s-3,1.343-3,3v1H4 C1.789,4,0,5.789,0,8v52c0,2.211,1.789,4,4,4h56c2.211,0,4-1.789,4-4V8C64,5.789,62.211,4,60,4z M49,3c0-0.553,0.447-1,1-1 s1,0.447,1,1v3v4c0,0.553-0.447,1-1,1s-1-0.447-1-1V6V3z M13,3c0-0.553,0.447-1,1-1s1,0.447,1,1v3v4c0,0.553-0.447,1-1,1 s-1-0.447-1-1V6V3z M62,60c0,1.104-0.896,2-2,2H4c-1.104,0-2-0.896-2-2V17h60V60z M62,15H2V8c0-1.104,0.896-2,2-2h7v4 c0,1.657,1.343,3,3,3s3-1.343,3-3V6h30v4c0,1.657,1.343,3,3,3s3-1.343,3-3V6h7c1.104,0,2,0.896,2,2V15z"></path> </g> </g></svg>
                                    <span>
                                    '.$created.'
                                    </span>
                                </div>
                                <a href="'.$href.'" class="hover-button">Xem chi tiết <svg width="25px" height="25px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="icomoon-ignore"> </g> <path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" fill="#000000"> </path> </g></svg></a>
                            </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemCourse')) {
    function htmlItemCourse($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = strip_tags($item['description']);
        $created = date('d-m-Y', strtotime($item['created_at']));

        $totalSeconds = $item['videos']->sum('duration');
        $hours   = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $totalDuration = $hours . 'hr ' . $minutes . 'min';


        $html .= '<div class="course-item">
                    <div class="course-item-info">
                        <div class="post-item-photo">
                            <a href="'.$href.'" class="course-image-container">
                                <img src="'.$img.'" alt="'.$title.'">
                            </a>
                        </div>
                        <div class="course-item-details">
                            <div class="course-info flex justify-between mb-3">
                                <span class="flex items-center whitespace-nowrap">
                                    <img class="h-4 w-4" src="'.asset('frontend/images/book-alt.svg').'" alt="">
                                    <span class="ml-1 text-black text-f14">'.count($item["videos"]).' '.trans('index.Lesson').'</span>
                                </span>
                                <span class="flex items-center whitespace-nowrap">
                                    <img src="'.asset('frontend/images/clock-time.svg').'" alt="" class="h-4 w-4">
                                    <span class="ml-1 text-black text-f14">'.$totalDuration.'</span>
                                </span>
                            </div>
                            <h3 class="course-item-title">
                                <a href="'.$href.'" style="text-align: justify;overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 2;-webkit-box-orient: vertical;display: -webkit-box;line-height: 27px;height: 54px;">'.$title.'</a>
                            </h3>
                           <div class="box-action">
                                <a href="'.$href.'" class="bg-black flex items-center rounded-[25px] text-white whitespace-nowrap">
                                    <img class="brightness-0 contrast-200 h-4 invert ml-1 w-4" src="'.asset('frontend/images/play-alt-1.svg').'" alt="" style="">
                                    <span class="ml-1 mr-2 text-f14">'.trans('index.StartCourse').'</span>
                                </a>
                           </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemMember')) {
    function htmlItemMember($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];
        $attr = groupAttr($item['attributes']);
        $html .= '<div class="team-item" style="width: 100%; display: inline-block;">
                    <div class="team-item-info">
                        <div class="team-item-photo">
                            <a href="'.$href.'" class="post-image-container"
                                tabindex="0">
                                <img src="'.$img.'" alt="'.$title.'">
                            </a>
                            <span class="circle"></span>
                        </div>
                        <div class="team-item-details">
                            <h3><a style="color:black" href="'.$href.'"
                                    tabindex="0">'.$title.'</a></h3>
                            <div class="team-item-meta">'.convertGroupAttr($attr).'</div>
                            <div class="team-item-review">
                                <img src="https://medlatec.vn/med/images/review.png" alt="'.$title.'" loading="lazy">
                            </div>
                            <div class="team-item-excerpt">'.$desc.'</div>
                            <div class="team-item-actions">
                                <a href="'.$href.'" tabindex="0">Đặt lịch</a>
                            </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}


if (!function_exists('htmlItemArticleAside')) {
    function htmlItemArticleAside($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];
        $attr = groupAttr($item['attributes']);
        $html .= '<div class="post-item post-item-list">
                <div class="post-item-info">
                    <div class="post-item-photo">
                        <a href="'.$href.'"
                            class="post-image-container">
                            <img src="'.$img.'" alt="'.$title.'">
                        </a>
                    </div>
                    <div class="post-item-details">
                        <div class="post-item-date">'.formatDateVietnamese($item['created_at']).'</div>
                        <h3 class="post-item-title">
                            <a href="'.$href.'">'.$title.'</a>
                        </h3>
                        <div class="post-item-excerpt">'.$desc.'</div>
                    </div>
                </div>
            </div>';
        return $html;
    }
}

if (!function_exists('htmlItemService')) {
    function htmlItemService($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];
        $attr = groupAttr($item['attributes']);
        $icon = asset('frontend/images/service.png');
        $html .= '<div class="service-item">
                    <div class="service-item-info">
                        <div class="service-item-photo">
                            <div class="service-item-image"> 
                                <a href="'.$href.'" class="hover-zoom">
                                    <img src="'.$img.'" alt="'.$title.'"> 
                                </a>
                            </div>
                        </div>
                        <div class="service-item-details">
                            <h3 class="service-item-title text-center"><a href="'.$href.'">'.$title.'</a></h3>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}


if (!function_exists('formatDuration')) {
    function formatDuration($seconds)
    {
        $hours   = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs    = $seconds % 60;

        // dạng HH:MM:SS
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $secs);
    }

}