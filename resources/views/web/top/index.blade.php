@extends('web.layouts.default2', ['title' => 'SoccerPlus - サッカープラス - ｜サッカーにおける全てのデータが1つに'], ['pageName' => 'fullPage topPage'])
@section('content')
<div id="keyv" class="keyv01">
    <div class="inner02">
        <div class="keyvContent">
            <h2 class="headline10"><img src="/assets/img/top/txt_keyv_football.png" alt="サッカーにおける 全てのデータが1つに! NO DATA NO STRATEGY"></h2>
            <p class="btnGroup">
                <a href="{{ route('web.contact.create') }}" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    オンラインガイダンスはこちら
                </a>
                <a href="{{ route('web.contact.create') }}" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    お問い合わせはこちら
                </a>
            </p>
        </div>
    </div>
</div>
<div class="inner02">
    <section class="movieIntro">
        <div class="movieAvatar">
            <div class="movieAvatarImg">
                <img src="/assets/img/top/img_video.jpg" alt="NO DATA NO STRATEGY">
            </div>
            <span class="movieAvatarBtn" id="jsPlay">
            {{-- <img src="/assets/img/svg/icon_play_video.svg" alt="NO DATA NO STRATEGY"> --}}
            </span>
            {{-- <div id="jsMovie" class="movieIframe">
                <iframe id="jsMovieIframe" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="【確認用】リラックスヨガ" width="640" height="360" src=""></iframe>
            </div> --}}
        </div>
        <div class="movieTitle">
            <div>
                <p class="ttl">NO DATA<br>NO STRATEGY</p>
            </div>
        </div>
    </section>
    <section id="sec01" class="section04">
        <h3 class="headline11">サービス紹介</h3>
        <div class="post mb0">
            <div class="postContent style01">
                <div class="postContentRow">
                    <figure class="postThumbnail">
                        <img src="/assets/img/top/img_service.jpg" alt="見出しタイトル">
                    </figure>
                    <div class="detail">
                        <p class="txtCm01 lHeight2">サッカーにおけるデータ分析は、サッカービジネスの最前線であるヨーロッパで始まりました。<br>
                            2018年6月のロシアW杯より通信機器のベンチへの持ち込みが解禁され、リアルタイムに映像やライブデータを参照できるようになり、リアルタイムにデータを分析する価値が一層高まりました。<br>
                            近年、日本においてもアマチュアからプロまで、データのサッカー界における重要度が大きくなっています。<br>
                            そのような情勢の中、弊社は「デジタルスコアブックによるリアルタイム分析」を通して、今後のサッカー界に変革を起こしたいと考えています。<br>
                            デジタルスコアブックでは、直感的で軽快な入力方法により集計したスタッツの分析や、確率等の詳細なデータの確認可能なため、コーチングやティーチングに加え、試合終了と同時に選手の振り返りにも活用することができます。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<section class="blockQuestion">
    <div class="inner02">
        <p class="ttl">各種お問い合わせ</p>
        <p class="btnGroup">
            <a href="{{ route('web.contact.create') }}" class="btnDeal btnPurple">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                        <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                            <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#fff"></circle>
                                <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#6b64c1"></path>
                            </g>
                        </g>
                    </svg>
                </span>
                オンラインガイダンスはこちら
            </a>
            <a href="{{ route('web.contact.create') }}" class="btnDeal btnPurple">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                        <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                            <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#fff"></circle>
                                <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#6b64c1"></path>
                            </g>
                        </g>
                    </svg>
                </span>
                お問い合わせはこちら
            </a>
        </p>
    </div>
</section>
<div class="sectBackground">
    <section id="sec02" class="section04">
        <div class="inner02">
            <h3 class="headline11">機能概要</h3>
            <div class="colGrid2 post mb0 mt0">
                <div class="postContent style02 mb20">
                    <div class="postContentRow">
                        <figure class="postThumbnail">
                            <img src="/assets/img/top/img_functional01.jpg" alt="リアルタイムスタッツ分析">
                        </figure>
                        <div class="detail">
                            <h4 class="ttlCmn01">リアルタイムスタッツ分析</h4>
                            <p class="txtCm01">試合進行に合わせて入力するスタイルにより、試合終了時点で数値データだけでなく確率、シュートチャートも表示することができます。</p>
                        </div>
                    </div>
                </div>
                <div class="postContent style02 mb20">
                    <div class="postContentRow">
                        <figure class="postThumbnail">
                            <img src="/assets/img/top/img_functional02.jpg" alt="スタッツ共有機能">
                        </figure>
                        <div class="detail">
                            <h4 class="ttlCmn01">スタッツ共有機能</h4>
                            <p class="txtCm01">入力したデータをサーバーへ送信することで、サッカープラスのWEB上でもスタッツが参照できるようになりますので、チーム関係者への共有がスムーズに行えます。<br>
                                WEBを介して、選手／指導者／保護者の方々など、いつでも、どこでも、気軽にスタッツを閲覧することができます。</p>
                        </div>
                    </div>
                </div>
                <div class="postContent style02 mb20">
                    <div class="postContentRow">
                        <figure class="postThumbnail">
                            <img src="/assets/img/top/img_functional03.jpg" alt="柔軟な詳細分析">
                        </figure>
                        <div class="detail">
                            <h4 class="ttlCmn01">柔軟な詳細分析</h4>
                            <p class="txtCm01">WEB上にスタッツを送信することで、期間別や試合別にソートしたより詳細な集計が可能です。例えば、大会期間中だけに期間を絞り、さらには特定の対戦相手の試合のみのデータを閲覧するなど、要望に合ったデータの抽出をすることができます。</p>
                        </div>
                    </div>
                </div>
                <div class="postContent style02 mb20">
                    <div class="postContentRow">
                        <figure class="postThumbnail">
                            <img src="/assets/img/top/img_functional04.jpg" alt="入力スタッツと動画連携">
                        </figure>
                        <div class="detail">
                            <h4 class="ttlCmn01">入力スタッツと動画連携</h4>
                            <p class="txtCm01">WEBサイト上へ送信したスタッツと、別途撮影した試合映像を連携し、実際の動画とスタッツを紐づけながら再生・閲覧することが可能です。さらに選手別・プレイ別ソートする機能も備えております。<br>
                                「スタッツ＋映像」により短時間で、より効率的に分析が可能になります。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="sec03" class="section04">
        <div class="inner02">
            <h3 class="headline11">商品紹介</h3>
            <div class="post mb0">
                <div class="postContent style01">
                    <div class="postContentRow">
                        <figure class="postThumbnail">
                            <img src="/assets/img/top/img_product.jpg" alt="商品紹介">
                        </figure>
                        <div class="detail">
                            <p class="txtCm01 lHeight2">デジタルスコアブック「Soccer Pad2」は、
                                タッチパネル式の入力方法により、シュート数やゴール数だけの簡易的な集計ではなく、
                                決定率、空中戦勝率、セカンドボール回収率も表示できるアプリケーションです。<br>
                                シュートチャートでは、シュートを放った座標に対してどのようなコースを辿ったかを表示することができます。さらには確率や分布を視覚化した、ヒートチャートを表示することができます。<br><br>
                                集計されたスタッツをアプリ上で分析することはもちろん、サッカープラス専用のWEBページにスタッツを送信することで、過去のデータを合算して集計をすることも、対戦チームのデータだけをソートしてアーカイブすることも、個人の選手データだけを抜き出して表示することも可能です。<br>
                                蓄積されたスタッツはチームアカウント内で保持されますので、
                                チームにとって貴重な財産となり、最強のパフォーマンスを発揮します。</p>
                            <p class="btnGroup style01">
                                <a href="/pdf/soccerplus_pricelist.pdf" class="btnDeal" target="_blank">
                                    <span>
                                        <img src="/assets/img/svg/icon_pdf.svg" alt="価格一覧">
                                    </span>
                                    価格一覧
                                </a>
                                <a href="/pdf/comparative_chart.pdf" class="btnDeal" target="_blank">
                                    <span>
                                        <img src="/assets/img/svg/icon_pdf.svg" alt="機能比較表">
                                    </span>
                                    機能比較表
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="section04">
        <div class="inner02">
            <h3 class="headline11">導入までの流れ</h3>
            <a href="#" class="flowIntro">
                <figure class="image">
                    <img src="https://dummyimage.com/1180x494/cccccc/000000" alt="導入までの流れ">
                </figure>
            </a>
        </div>
    </section> --}}
</div>
<section class="blockQuestion">
    <div class="inner02">
        <p class="ttl">各種お問い合わせ</p>
        <p class="btnGroup">
            <a href="{{ route('web.contact.create') }}" class="btnDeal btnPurple">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                        <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                            <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#fff"></circle>
                                <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#6b64c1"></path>
                            </g>
                        </g>
                    </svg>
                </span>
                オンラインガイダンスはこちら
            </a>
            <a href="{{ route('web.contact.create') }}" class="btnDeal btnPurple">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                        <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                            <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#fff"></circle>
                                <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#6b64c1"></path>
                            </g>
                        </g>
                    </svg>
                </span>
                お問い合わせはこちら
            </a>
        </p>
    </div>
</section>
<div class="sectBackground">
    <section id="sec04" class="section04">
        <div class="inner02">
            <h3 class="headline11">プレミアムチームのご案内</h3>
            <div class="post mb0">
                <div class="postContent style01">
                    <div class="postContentRow">
                        <figure class="postThumbnail">
                            <img src="/assets/img/top/img_team_intro01.jpg" alt="プレミアムチームのご案内">
                        </figure>
                        <div class="detail">
                            <p class="txtCm01 lHeight2">Soccer Pad2は、スポーツ少年団やクラブチーム、プロチームまで幅広くご利用いただける、タッチパネル式で直感的なインタフェースが特長の『サッカー専用スタッツ集計・分析アプリケーション』です。<br><br>
                                各試合のスタッツは、リアルタイムでチームスタッツ・個人スタッツ・シュートチャート・比較表に反映され、ハーフタイム時など、選手に具体的な指示を出す際に即時に活用できる画期的なツールとなります。<br><br>
                                試合後、サッカープラス専用のWEBページに試合スタッツを送信すると、対戦チームとの戦力比較や期間別データなどが表示され、試合内容の分析やチーム内の強化すべきポイントを発見することができるでしょう。</p>
                        </div>
                    </div>
                </div>
                <div class="postContent style01">
                    <div class="postContentRow">
                        <div class="detail">
                            <p class="txtCm01 lHeight2">Soccer Pad2のプレミアムチームにご契約いただければ、アプリケーションを用いたスタッツ集計によるチームの強化はもちろん、コールセンターによるユーザーサポートなど、アプリケーションを継続して運用するための様々なサービスをご利用いただけます。<br><br>
                                Soccer Pad2で入力された試合データは、サッカープラスのクラウドサーバー上にアップされ、自チームと対戦チームの様々な戦力（各アクションの決定率や空中戦勝率、セカンドボール回収率など）比較が可能になります。<br><br>
                                PCをはじめ、スマートフォン、タブレット端末など、様々なデバイスでアクセスできるのもサッカープラスの魅力です。試合を見に行くことができない保護者の方でも、ご自宅や職場でお子様の試合結果や出場状況などをご確認頂くことが可能になります。</p>
                        </div>
                        <figure class="postThumbnail">
                            <img src="/assets/img/top/img_team_intro02.jpg" alt="プレミアムチームのご案内">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="section04">
        <div class="inner02">
            <h3 class="headline11">プレミアムチームのご案内</h3>
            <div class="accordionItem">
                <p class="ques jsAccordion"><span>Q.</span><span>「Soccer-Plus」アプリで何ができますか？</span></p>
                <div class="jsAccordionBox">
                    <p class="ans"><span>A.</span><span>「Soccer-Plus」とは、サッカーの試合記録ををつけ、結果を分析できるiPad専用アプリです。 <br>
アプリをプリインストールしたiPadをレンタルする事でご利用いただけます。</span></p>
                </div>
            </div>
            <div class="accordionItem">
                <p class="ques jsAccordion"><span>Q.</span><span>「Soccer-Plus」アプリの申し込み方法を教えてください。</span></p>
                <div class="jsAccordionBox">
                    <p class="ans"><span>A.</span><span>「Soccer-Plus」とは、サッカーの試合記録ををつけ、結果を分析できるiPad専用アプリです。<br>アプリをプリインストールしたiPadをレンタルする事でご利用いただけます。</span></p>
                </div>
            </div>
            <div class="accordionItem">
                <p class="ques jsAccordion"><span>Q.</span><span>利用を開始したい</span></p>
                <div class="jsAccordionBox">
                    <p class="ans"><span>A.</span><span>「Soccer-Plus」とは、サッカーの試合記録ををつけ、結果を分析できるiPad専用アプリです。<br>アプリをプリインストールしたiPadをレンタルする事でご利用いただけます。</span></p>
                </div>
            </div>
            <a href="#" class="btnDeal">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                        <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                            <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                            </g>
                        </g>
                    </svg>
                </span>
                すべての質問を見る
            </a>
        </div>
    </section> --}}
    <section class="section04">
        <div class="inner02">
            <div class="post mb0">
                <div class="postContent style04">
                    <div class="postContentRow">
                        <div class="guidance">
                            <figure class="image">
                                <img src="/assets/img/top/img_info_contact.svg" alt="概要説明操作指導">
                            </figure>
                        </div>
                        <div class="postThumbnail">
                            <div class="boxContact style01">
                                <p class="ttl"><span class="sub">iPadセットモデル「Soccer Pad2」専用ダイヤル</span>オンラインガイダンス</p>
                                <div class="contact">
                                    <div class="intro">
                                        <a href="tel:0120945432" class="phone">0120-945-432</a>
                                        <span class="sub">※バスケプラス社のフリーダイヤルです。</span>
                                    </div>
                                    <p class="receptionHour">
                                        受付時間
                                        <span class="time">10:00 ~ 18:00</span>
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('web.contact.create') }}" class="btnDeal btnPurple">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                        <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                            <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                                <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#fff"></circle>
                                                <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#6b64c1"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                                フォームからお問い合わせ
                            </a>
                            <p class="mailto">
                                AppStore版：
                                <a href="mailto:info@soccer-plus.jp" target="_blank">
                                    <svg>
                                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon-email"></use>
                                    </svg>
                                    info@soccer-plus.jp
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="section04">
        <div class="inner02">
            <h3 class="headline11">お知らせ一覧</h3>
            <ul class="newsList style01">
                <li class="newsItem">
                    <div class="postTime gap30">
                        <time>2022年07月07日</time>
                        <span>お知らせ</span>
                    </div>
                    <p class="newsTitle">2022年7月1日『日刊工業新聞』に記事が掲載されました。</p>
                </li>

                <li class="newsItem">
                    <div class="postTime gap30">
                        <time>2022年06月26日</time>
                        <span>カテゴリ</span>
                    </div>
                    <p class="newsTitle">2022年3月11日『神奈川新聞』に記事が掲載されました。</p>
                </li>

                <li class="newsItem">
                    <div class="postTime gap30">
                        <time>2022年05月25日</time>
                        <span>カテゴリ</span>
                    </div>
                    <p class="newsTitle">Volley Pad2 iPadセットモデル 36か月レンタル版価格表</p>
                </li>

                <li class="newsItem">
                    <div class="postTime gap30">
                        <time>2022年06月24日</time>
                        <span>カテゴリ</span>
                    </div>
                    <p class="newsTitle">オンラインでの商品をご案内について</p>
                </li>
            </ul>
        </div>
    </section> --}}
</div>
<div class="pageTop01">
    <a href="#">
        <svg class="icon">
            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_top" />
        </svg>
        <span class="txt">PAGE TO TOP</span>
    </a>
</div>
<section class="section05 staticPageTop">
    <div class="inner02">
        <div class="inquiryBlock">
            <p class="inquiryTxt">サービスに関する<br class="pcDisplay">お問い合わせ</p>
            <div class="boxContact">
                <p class="inquiryPhone">
                    <span>iPadセットモデル<br>
                    <span class="sticky">Soccer Pad2</span>
                    専用ダイヤル</span>
                    <img src="/assets/img/top/img_phone.png" alt="">
                </p>
                <div class="contact">
                    <a href="tel:0120945432" class="phone">0120-945-432</a>
                    <span class="sub">※バスケプラス社のフリーダイヤルです。</span>
                    <p class="receptionHour">
                        電話予約 受付時間 /
                        <span class="time">10:00 ~ 18:00</span>
                    </p>
                </div>
            </div>
        </div>
        <ul class="btnGroupList">
            <li>
                <a href="{{ route('web.contact.create') }}" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    オンラインガイダンスはこちら
                </a>
            </li>
            <li>
                <a href="{{ route('web.contact.create') }}" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    お問い合わせはこちら
                </a>
            </li>
            {{-- <li>
                <a href="#" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    よくある質問はこちら
                </a>
            </li> --}}
        </ul>
        <p class="mailto style01">
            AppStore版：
            <a href="mailto:info@soccer-plus.jp" target="_blank">
                <svg>
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon-email"></use>
                </svg>
                info@soccer-plus.jp
            </a>
        </p>
    </div>
</section>
@endsection
