@if( isset($item->children) )
    <div class="home-block-3 wow fadeInUp">
        <div class="row">
            @foreach ($item->children as $cat)
            @php
                $postsChuck = array_chunk($cat->posts->toArray(), 5);
            @endphp
               <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="block-title">
                        <h2 style="border-bottom: 2px solid #7f8fa9;">{{ $cat->title }}</h2>
                    </div>
                    <div class="swiper-for-col swiper-container wow fadeInUp" data-wow-delay="0.4s">
                        <div class="swiper-wrapper">
                            @foreach ($postsChuck as $itemChuck)
                                <div class="swiper-slide">
                                    @foreach ($itemChuck as $k => $post )
                                        <div class="item @if($k > 0) flex-module1 @endif">
                                            <div class="image" style="position:relative">
                                                <a href="{{ route('routerURL', ['slug' => $post['slug']]) }}">
                                                    <img src="{{ asset(!empty($post['image']) ? $post['image'] : 'images/404.jpg') }}" alt="">
                                                </a>
                                                @if($k == 0)
                                                <a href="{{ route('routerURL', ['slug' => $cat->slug]) }}" class="category category-absolute">{{$cat->title}}</a>
                                                @endif
                                            </div>
                                            <div class="nav-image">
                                                <h3 class="title section-title">
                                                    <a href="{{ route('routerURL', ['slug' => $post['slug']]) }}">{{ $post['title'] }}</a>
                                                </h3>
                                                <p class="date ctm-date">{{ date('d/m/Y', strtotime($post['created_at'])) }}</p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> 
            @endforeach
            
            <div class="col-md-6 col-sm-6 col-xs-12" style="display: none">
                <div class="block-title">
                    <h2 style="border-bottom: 2px solid #7f8fa9;">槓桿韓國語</h2>
                </div>
                <div class="swiper-for-col swiper-container wow fadeInUp" data-wow-delay="0.4s">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="item">
                                <div class="image" style="position:relative">
                                    <a href="10-5-ez-g6055.html">
                                        <img src="https://ezdaily.tamphat.edu.vn/uploads/.thumbs/images/phap/phap-t10/hoc-ngon-ngu-2-doanhnhansai-1508438609-750x0.jpg" alt="">
                                    </a>
                                    <a href="10-6-x-g6056.html" class="category category-absolute">槓桿法國語</a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title section-title">
                                        <a href="10-5-ez-g6055.html">[會員限定] 10月5日 零起點跟 EZ一步步學好法語 - 第六回：雙母音發音</a>
                                    </h3>
                                    <p class="date ctm-date">2023/10/05</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="item flex-module1">
                                <div class="image" style="position:relative">
                                    <a href="10-5-ez-g6055.html">
                                        <img src="https://ezdaily.tamphat.edu.vn/uploads/.thumbs/images/phap/phap-t10/hoc-ngon-ngu-2-doanhnhansai-1508438609-750x0.jpg" alt="">
                                    </a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title">
                                        <a href="10-5-ez-g6055.html">[會員限定] 10月5日 零起點跟 EZ一步步學好法語 - 第六回：雙母音發音</a>
                                    </h3>
                                    <p class="date ctm-date">2023/10/05</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="item flex-module1">
                                <div class="image" style="position:relative">
                                    <a href="10-5-ez-g6055.html">
                                        <img src="https://ezdaily.tamphat.edu.vn/uploads/.thumbs/images/phap/phap-t10/hoc-ngon-ngu-2-doanhnhansai-1508438609-750x0.jpg" alt="">
                                    </a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title">
                                        <a href="10-5-ez-g6055.html">[會員限定] 10月5日 零起點跟 EZ一步步學好法語 - 第六回：雙母音發音</a>
                                    </h3>
                                    <p class="date ctm-date">2023/10/05</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="item flex-module1">
                                <div class="image" style="position:relative">
                                    <a href="10-5-ez-g6055.html">
                                        <img src="https://ezdaily.tamphat.edu.vn/uploads/.thumbs/images/phap/phap-t10/hoc-ngon-ngu-2-doanhnhansai-1508438609-750x0.jpg" alt="">
                                    </a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title">
                                        <a href="10-5-ez-g6055.html">[會員限定] 10月5日 零起點跟 EZ一步步學好法語 - 第六回：雙母音發音</a>
                                    </h3>
                                    <p class="date ctm-date">2023/10/05</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="item flex-module1">
                                <div class="image" style="position:relative">
                                    <a href="10-5-ez-g6055.html">
                                        <img src="https://ezdaily.tamphat.edu.vn/uploads/.thumbs/images/phap/phap-t10/hoc-ngon-ngu-2-doanhnhansai-1508438609-750x0.jpg" alt="">
                                    </a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title">
                                        <a href="10-5-ez-g6055.html">[會員限定] 10月5日 零起點跟 EZ一步步學好法語 - 第六回：雙母音發音</a>
                                    </h3>
                                    <p class="date ctm-date">2023/10/05</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="item flex-module1">
                                <div class="image" style="position:relative">
                                    <a href="10-5-ez-g6055.html">
                                        <img src="https://ezdaily.tamphat.edu.vn/uploads/.thumbs/images/phap/phap-t10/hoc-ngon-ngu-2-doanhnhansai-1508438609-750x0.jpg" alt="">
                                    </a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title">
                                        <a href="10-5-ez-g6055.html">[會員限定] 10月5日 零起點跟 EZ一步步學好法語 - 第六回：雙母音發音</a>
                                    </h3>
                                    <p class="date ctm-date">2023/10/05</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif