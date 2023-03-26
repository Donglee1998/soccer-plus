@extends('web.layouts.default', ['title' => 'test'])
@section('content')
<div class="inner01">
    <!-- post -->
    <article class="post">
        <div class='headline4'>
            <div class="postTime">
                <time>2022年07月07日</time>
                <a href="#">お知らせ</a>
            </div>
            <h2>2022年7月1日『日刊工業新聞』に記事が掲載されました。</h2>
        </div>

        <div class="postContent">
            <div class="postContentRow">
                <figure class="postThumbnail">
                    <img src="https://dummyimage.com/520x375/cccccc/000000" alt="ダミー画像">
                </figure>

                <p class="txtCm01">ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります。 ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります。</p>
            </div>

            <p class="txtCm01">ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります。 ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります。</p>
        </div>

        <p class="txtNote">※日刊工業新聞社の転載承認を受けています。</p>
    </article>

    <!-- news -->
    <section>
        <div class='headline4'>
            <h2>サッカーとデータ分析</h2>
        </div>

        <ul class="newsList">
            <li class="newsItem">
                <div class="postTime gap30">
                    <time>2022年07月07日</time>
                    <a href="#">お知らせ</a>
                </div>
                <a class="newsTitle" href="#">2022年7月1日『日刊工業新聞』に記事が掲載されました。</a>
            </li>

            <li class="newsItem">
                <div class="postTime gap30">
                    <time>2022年06月26日</time>
                    <a href="#">カテゴリ</a>
                </div>
                <a class="newsTitle" href="#">2022年3月11日『神奈川新聞』に記事が掲載されました。</a>
            </li>

            <li class="newsItem">
                <div class="postTime gap30">
                    <time>2022年05月25日</time>
                    <a href="#">カテゴリ</a>
                </div>
                <a class="newsTitle" href="#">Volley Pad2 iPadセットモデル 36か月レンタル版価格表</a>
            </li>

            <li class="newsItem">
                <div class="postTime gap30">
                    <time>2022年06月24日</time>
                    <a href="#">カテゴリ</a>
                </div>
                <a class="newsTitle" href="#">オンラインでの商品をご案内について</a>
            </li>
        </ul>
    </section>

    <!-- pager -->
    <div class="pager">
        <span class="pagerOlderLink">
            <a class="btnPagerCmn" href="#">
                <svg class="iconArrow">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_prev" />
                </svg>
                前へ
            </a>
        </span>
        <span class="pagerHomeLink">
            <a class="btnPagerCmn" href="#">一覧に戻る</a>
        </span>
        <span class="pagerNewerLink">
            <a class="btnPagerCmn active" href="#">
                次へ
                <svg class="iconArrow">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_next" />
                </svg>
            </a>
        </span>
    </div>

    <!-- pagerHasPaginate -->
    <div class="pager">
        <span class="pagerOlderLink">
            <a class="btnPagerCmn" href="#">
                <svg class="iconArrow">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_prev" />
                </svg>
                前へ
            </a>
        </span>

        <div class="pagerPagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
        </div>

        <span class="pagerPaginationSP">
            <span>1</span> / <span>3</span>
        </span>

        <span class="pagerNewerLink">
            <a class="btnPagerCmn active" href="#">
                次へ
                <svg class="iconArrow">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_next" />
                </svg>
            </a>
        </span>
    </div>

    <!-- btnbtnStrategy -->
    <a href="#" class="btnStrategy">
        チェックした作戦を削除
        <span>
            <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
        </span>
    </a>

    <a href="#" class="btnStrategy">
        作戦ボード一覧に戻る
        <span class="positionLeft">
            <img src="/assets/img/svg/ic_circle_left.svg" alt="アイコンサークル左">
        </span>
    </a>

    <a href="#" class="btnStrategy">
        確認する
        <span>
            <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸右">
        </span>
    </a>

    <!-- aboutOur -->
    <section class="aboutOur">
        <div class="aboutOurRow">
            <span>社名</span>
            <span>株式会社バスケプラス</span>
        </div>
        <div class="aboutOurRow">
            <span>本社所在地</span>
            <span>〒146-0083 東京都大田区千鳥2-17-7<br />Tel：03-4376-5171</span>
        </div>
        <div class="aboutOurRow">
            <span>代表者</span>
            <span>代表取締役　盛 透</span>
        </div>
        <div class="aboutOurRow">
            <span>資本金</span>
            <span>10,000,000円（2020年8月末現在）</span>
        </div>
        <div class="aboutOurRow">
            <span>設立</span>
            <span>2020年8月27日</span>
        </div>
        <div class="aboutOurRow">
            <span>事業内容</span>
            <span>インターネット関連事業<br />携帯電話等通信商材販売・取次事業<br />ソフトウェアの企画・開発・販売等事業<br />上記に付帯又は関連する事業</span>
        </div>
    </section>

    <!-- table -->
    <table class="tableInfo blockMb40Sp30">
        <tr>
            <th class="wid100">説明</th>
            <td class="left">選手 同士があまり 距離を取らず細かく パスを交換しながら ゴールを狙う</td>
        </tr>
        <tr>
            <th>作戦の種類</th>
            <td class="left">攻撃</td>
        </tr>
        <tr>
            <th>状況</th>
            <td class="left">通常時</td>
        </tr>
        <tr>
            <th>コートの種類</th>
            <td class="left">フルコート</td>
        </tr>
    </table>

    <!-- btnDeal -->
    <div class="btnDealWrapper">
        <a href="#" class="btnDeal">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                    <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                        <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                            <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1" />
                            <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff" />
                        </g>
                    </g>
                </svg>
            </span>
            プレミアムチームとは
        </a>
        <a href="#" class="btnDeal">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                    <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                        <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                            <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1" />
                            <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff" />
                        </g>
                    </g>
                </svg>
            </span>
            利用料金について
        </a>
    </div>

    <!-- matchInfo -->
    <section style="margin-top: 50px">
        <div class='headline4'>
            <h2>スタッツ</h2>
        </div>

        <table class="matchTableInfo tableInfo">
            <tr>
                <th colspan="2" class="thFull thFullSP">検索条件</th>
            </tr>
            <tr>
                <th rowspan="3" class="thFull thFullPC">検索条件</th>
                <th>期間</th>
                <td>2022/06/01-2022/07/10</td>
            </tr>
            <tr>
                <th>対戦 チーム</th>
                <td>チームA</td>
            </tr>
            <tr>
                <th>試合の種類</th>
                <td>公式試合</td>
            </tr>
        </table>

        <h2 style="margin: 50px 0" class="headline5">試合別集計</h2>
    </section>

    <!-- note -->
    <section style="margin: 50px 0">
        <p class="txtNote">
            お問い合わせの際は、特にメールアドレスなど、 下記各項目が正しい内容かどうかご確認の上、お問い合わせください。<br />メールアドレス相違の場合は弊社より返信できませんのでご注意ください。<br /><br /><span>尚、iPadレンタル版アプリ「Soccer Pad2」のみ、 ZOOM等を活用したオンラインでの商品案内を受け付けております。<br />オンラインでのご案内をご希望のお客様は、 下記内容をお問い合わせ内容にご明記の上、お問い合わせください。</span>
        </p>

        <ul class="listContent">
            <li class="txtNote">ご希望の日時(いくつか候補があればご記載 ください。)</li>
            <li class="txtNote">参加 希望 人数</li>
            <li class="txtNote">ご希望の利用 プラン(任意)</li>
            <li class="txtNote">その他、事前にご質問等あればご記載 ください。</li>
        </ul>

        <ul class="listContent1">
            <li class="txtNote1"><span>※</span> 所要時間は30分ほどです。</li>
            <li class="txtNote1"><span>※</span> App Store版では上記オンラインでの商品紹介は受け付けておりません。</li>
        </ul>
    </section>

    <!-- boxed -->
    <div class="boxedCmn">
        <h2 class="headline6">iPadセットモデル <span>(36か月レンタル版)</span></h2>
        <div class="flexBox">
            <a class="btnCmn1" href="#">専用ダイヤル</a>
            <a class="phoneNumber" href="tel:0120-945-432">0120-945-432</a>
        </div>
        <span class="receptionistTime">受付時間 10：00～18：00</span>
    </div>

    <!-- col2 -->
    <div class="colGrid2">
        <p class="colGrid2Item">
            <img src="https://dummyimage.com/520x320/cccccc&text=++" alt="ダミー画像">
        </p>
        <p class="colGrid2Item">
            <img src="https://dummyimage.com/520x320/cccccc&text=++" alt="ダミー画像">
        </p>
        <p class="colGrid2Item">
            <img src="https://dummyimage.com/520x320/cccccc&text=++" alt="ダミー画像">
        </p>
        <p class="colGrid2Item">
            <img src="https://dummyimage.com/520x320/cccccc&text=++" alt="ダミー画像">
        </p>
    </div>

    <!-- table2 -->
    <div class="tableTeam">
        <table>
            <tr>
                <th>チーム名</th>
                <td>チームサッカープラス1</td>
            </tr>
            <tr>
                <th>略称</th>
                <td>TSP1</td>
            </tr>
            <tr>
                <th>チーム カラー</th>
                <td>ホーム / アウェイ</td>
            </tr>
            <tr>
                <th>チーム 性別</th>
                <td>男子</td>
            </tr>
            <tr>
                <th>ホーム タウン</th>
                <td>池袋</td>
            </tr>
            <tr>
                <th>監督</th>
                <td>山田太郎</td>
            </tr>
            <tr>
                <th>コーチ</th>
                <td>鈴木 一郎</td>
            </tr>
            <tr>
                <th>マネージャー</th>
                <td>山田太/鈴木 一郎</td>
            </tr>
            <tr>
                <th>トレーナー</th>
                <td>鈴木 一郎/高橋 三郎</td>
            </tr>
            <tr>
                <th>説明</th>
                <td>ここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入ります。</td>
            </tr>
        </table>
    </div>
</div>
@endsection
