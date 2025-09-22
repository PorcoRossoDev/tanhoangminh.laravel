@extends('homepage.layout.home')
@section('content')
    <?php
    
    ?>
    <div class="main-page">
        <div class="container">
            <div class="banner">
                <img src="https://ezacademy.net/uploads/images/94870310/banner-1/a2-by-cindy-yu-.jpg" alt="">
            </div>
            <div class="content-page">
                <h1 class="page-title text-center">{{ $detail->title }}</h1>

                <div class="preview-video text-center">
                    @if (!empty(showField($detail->fields, 'config_colums_input_course_preview_video')))
                        <iframe src="{{ showField($detail->fields, 'config_colums_input_course_preview_video') }}"
                            width="560" height="315" frameborder="0"></iframe>
                    @endif
                </div>


                <div class="tabBlock">
                    <div class="content-tab-block">
                        <ul class="tabBlock-tabs text-center">
                            <li class="tabBlock-tab is-active">介紹</li>
                            <li class="tabBlock-tab">詳細內容</li>
                            <li class="tabBlock-tab">師資</li>
                            <li class="tabBlock-tab">常見問題</li>
                        </ul>
                        <div class="tabBlock-content">
                            <div class="tabBlock-pane">
                                <div class="content-content">
                                    <p><span style="font-size:18px;"><strong>英語文法的基本組成與常見錯誤</strong></span><br>
                                        &nbsp;</p>
    
                                    <p><span style="font-size:18px;">英語句子的基本組成通常包括以下幾個部分：</span></p>
    
                                    <p><span style="font-size:18px;">1. 主語 (Subject)：句子中的主角，通常是名詞或代名詞，例：She, The cat。<br>
                                            2. 謂語 (Predicate)：描述主語的動作或狀態，通常由動詞及其賓語組成，例：eats, is running。<br>
                                            3. 賓語 (Object)：動作的接受者，通常是名詞或名詞短語，例：an apple, the book<br>
                                            例句：<br>
                                            - 完整句型：The dog (主語) barks (謂語) at strangers (賓語)。</span></p>
    
                                    <p><span style="font-size:18px;">二、常見錯誤</span></p>
    
                                    <p><span style="font-size:18px;">在學習英語的過程中，很多學習者會犯一些常見的錯誤。以下是幾個典型的例子：</span></p>
    
                                    <p><span style="font-size:18px;">1. 主謂一致錯誤 (Subject-Verb Agreement)：<br>
                                            - 錯誤示例：The group of students are going to the park.<br>
                                            - 正確表達：The group of students is going to the park.<br>
                                            - 解析：主語“group”是單數形式，因此謂語動詞也要使用單數形式。</span></p>
    
                                    <p><span style="font-size:18px;">2. 時態錯誤 (Tense Errors)：<br>
                                            - 錯誤示例：I go to the store yesterday.</span></p>
    
                                    <p>&nbsp;</p>
    
                                    <p><span style="font-size:18px;"><img alt="" src="https://ezacademy.net/uploads/images/20250414/2.jpg"
                                                style="width: 600px; height: 338px;"></span></p>
    
                                    <p><span style="font-size:18px;"><img alt="" src="https://ezacademy.net/uploads/images/20250414/3.jpg"
                                                style="width: 600px; height: 338px;"></span></p>
    
                                    <p><span style="font-size:18px;"><img alt="" src="https://ezacademy.net/uploads/images/20250414/4.jpg"
                                                style="width: 600px; height: 338px;"></span></p>
                                </div>
                            </div>
                            <div class="tabBlock-pane">
                                <div class="">
                                    <p><strong><span style="font-size:18px;">十倍速英語文法-基本組成&amp;常見錯誤</span></strong></p>
                                    <p><strong><span style="font-size:18px;">本課程長度為21分鐘</span></strong></p>
                                </div>
                            </div>
                            <div class="tabBlock-pane">
                                <div>
                                    <p><span style="font-size:18px;"><strong>Michelle Chen 老師&nbsp;</strong></span></p>
    
                                    <p><span style="font-size:18px;">Michelle Chen老師目前旅居於國外，擁有多年的英語教學經驗。她的個性活潑開朗，非常喜歡與學生互動，讓課堂充滿樂趣和活力。Michelle老師深信，學習英語不僅僅是學習語言，更是開啟一扇通往世界的窗戶。</span></p>
    
                                    <p><span style="font-size:18px;">在教學中，Michelle老師總是以認真負責的態度面對每一位學生，努力確保每個人都能在輕鬆愉快的環境下學習。她運用各種有趣及創新的教學方法，讓學生能夠在實際情境中運用英語，激發他們的學習興趣與熱情。</span></p>
    
                                    <p><span style="font-size:18px;">不論是通過互動遊戲、角色扮演，Michelle老師都能將英語學習變得生動有趣，使每個學生都能在她的課堂上獲得成長與進步。相信在Michelle老師的引導下，學生們將能自信地掌握英語，拓展更廣泛的視野！</span></p>
                                </div>
                            </div>
                            <div class="tabBlock-pane">
                                <div>
                                    <p><span style="font-size:18px;"><strong>Q1：要如何觀看本課程？</strong><br>
                                        A1：請訂閱Easy Language的終身會員VVIP，可全站無限暢讀雜誌、工具書、影音課。<br>
                                        <a href="https://faststudy.easy.co/collections/00vvip/products/272card">https://faststudy.easy.co/collections/00vvip/products/272card</a><br>
                                        <strong>&nbsp;<br>
                                        Q2：成為終身會員VVIP後，該如何進站學習呢？</strong><br>
                                        A2：完成訂閱後，會有專人寄信跟您確認，之後只要註冊會員開通帳號後，在本網站內就能使用。我們不是募資教材，所有課程都已經製作好，繳費後在上班日當天就可以使用。<br>
                                        <strong>&nbsp;<br>
                                        Q3：成為終身會員VVIP後，是否所有的內容都可以觀看？</strong><br>
                                        A3：沒錯！不管任何語言的任何課程，只要是終身會員VVIP，都可以無限次數觀看。<br>
                                        <strong>&nbsp;<br>
                                        Q4：成為終身會員VVIP後，課程還會再更新嗎？</strong><br>
                                        A4：我們保證月月更新，每月都會上架新課程，有想學的語種跟主題，也歡迎直接跟編輯部許願。雜誌也會每月出新刊。<br>
                                        <strong>&nbsp;<br>
                                        Q5：現在的價格是最便宜嗎？</strong><br>
                                        A5：隨著內容越來越多，終身會員VVIP的價格也會持續調漲，因此越早加入，越快能開始學習之路。<br>
                                        <strong>&nbsp;<br>
                                        Q6：有沒有年齡或程度上的限制？</strong><br>
                                        A6：沒有限制，我們有多種外語課程，創立10多年以來，最年輕的學員 8歲，最資深的 70 多歲，年紀不是問題，教材內容從零基礎到中高級都有，重要的是內容對你有所幫助，能讓你真正學到東西。<br>
                                        <strong>&nbsp;<br>
                                        Q7：課前要有什麼樣的準備?</strong><br>
                                        A7：只要有願意投入認真學習的心就可以。<br>
                                        <strong>&nbsp;<br>
                                        Q8：請問每一個課程影片，要花多久時間學習？</strong><br>
                                        A8：每個主題課程長短不一，從4小時至25小時都有，但我們是採取知識點設計，讓大部分的課程段落時間落在10~15分鐘之間，擷取各主題的精華，讓你事半功倍，也適合在通勤等零碎時間學習。<br>
                                        <strong>&nbsp;<br>
                                        Q9：我的外語程度已經很不錯，想要更精進有辦法讓我達到嗎？</strong><br>
                                        A9：網站內有進階課程，非常適合基礎好的學員。我們有數十位老師跟上百位的編輯團隊，內容都是獨家製作，具有一定的豐富度以及深度，讓你能精準吸收與表達，且外語種類多達17種，不怕你來學，只怕你不學！<br>
                                        <strong>&nbsp;<br>
                                        Q10. 請問課程中想發問題有什麼管道嗎？</strong><br>
                                        A10：可以透過「學員信箱」或「客服LINE」發送問題，在購買後都會收到我們通知信，有問題直接回問。回覆問題的人都來自編輯部成員，所以您可以得到真實並且來自老師們的答案回覆。並且我們會每天瀏覽大家的問題統一回覆，通常都能在隔天內得到問題的答案。</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('css')
@endpush

@push('javascript')
    <script>
        var TabBlock = {
            s: {
                animLen: 200
            },

            init: function() {
                TabBlock.bindUIActions();
                TabBlock.hideInactive();
            },

            bindUIActions: function() {
                $('.tabBlock-tabs').on('click', '.tabBlock-tab', function() {
                    TabBlock.switchTab($(this));
                });
            },

            hideInactive: function() {
                var $tabBlocks = $('.tabBlock');

                $tabBlocks.each(function(i) {
                    var
                        $tabBlock = $($tabBlocks[i]),
                        $panes = $tabBlock.find('.tabBlock-pane'),
                        $activeTab = $tabBlock.find('.tabBlock-tab.is-active');

                    $panes.hide();
                    $($panes[$activeTab.index()]).show();
                });
            },

            switchTab: function($tab) {
                var $context = $tab.closest('.tabBlock');

                if (!$tab.hasClass('is-active')) {
                    $tab.siblings().removeClass('is-active');
                    $tab.addClass('is-active');

                    TabBlock.showPane($tab.index(), $context);
                }
            },

            showPane: function(i, $context) {
                var $panes = $context.find('.tabBlock-pane');

                // Normally I'd frown at using jQuery over CSS animations, but we can't transition between unspecified variable heights, right? If you know a better way, I'd love a read it in the comments or on Twitter @johndjameson
                $panes.slideUp(TabBlock.s.animLen);
                $($panes[i]).slideDown(TabBlock.s.animLen);
            }
        };

        $(function() {
            TabBlock.init();
        });
    </script>
@endpush
