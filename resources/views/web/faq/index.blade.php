@extends('web.layouts.default', ['title' => 'FAQ'], ['pageName' => 'pageFaq'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="よくあるご質問">
    <h1 class="keyvTitle">よくあるご質問</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a> <span>/</span></li>
            <li><em>よくあるご質問</em></li>
        </ul>

        <div class="section02">
            <h2 class="headline4">「Soccer-Plus」とは</h2>
            <div class="accordionItem nonAccor">
                <p class="ques"><span>Q.</span><span>SoccerPad2では何ができますか？</span></p>
                <div>
                    <p class="ans"><span>A.</span><span>誰でも簡単にリアルタイム分析、詳細データ分析、スカウティング分析ができるiPad専用アプリケーションです。<br>
                        アプリをプリインストールした状態でiPadをレンタル致しますので、設定など弊社にお任せいただいた上でご利用いただけます。</span></p>
                </div>
            </div>
            <div class="accordionItem nonAccor">
                <p class="ques"><span>Q.</span><span>レンタル版の「SoccerPad2」と、App Store版の「SoccerPlus」の違いは何ですか？</span></p>
                <div>
                    <div class="ans"><span>A.</span>
                        <div>
                            <p class="ansTxt">SoccerPad2はアプリをプリインストールしたiPadをレンタルする事でご利用いただけます。<br>
                                SoccerPlusはお客様のお手元にございますAppstoreよりダウンロードいただきご利用いただけます。</p>
                            <p class="ansTxt">また、機能やサポートに関して違いがございますので、詳しくは当HPの「機能比較」よりご確認ください。<br>
                                下記URLより、お申し込みいただく事でご利用いただけます。<br>
                                <a href="/entry">soccer-plus.jp/entry</a>
                            </p>
                            <p>ご利用をご検討されている場合は、フリーダイヤルにでご相談ください。<br>
                                各種機能やご契約、オプションサービスについてご案内致します。<br>
                                ※App Store版「Socce Plus」につきましては、お客様所有のiPadにてApp Storeよりダウンロードしてください。<br>
                                尚、ご利用のチームアカウント作成については、弊社事務局で対応致します。<br>
                                必要事項は追ってメール等でご案内いたします。</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordionItem nonAccor">
                <p class="ques"><span>Q.</span><span>操作方法を教えてください</span></p>
                <div>
                    <p class="ans"><span>A.</span><span>アプリの使い方については、ご利用開始より1か月に2回を目途に、オンラインにて操作案内をさせていただいております。<br>
                        当HPより操作マニュアルもご参照いただけます。</span></p>
                </div>
            </div>
            <div class="accordionItem nonAccor">
                <p class="ques"><span>Q.</span><span>支払方法を教えてください</span></p>
                <div>
                    <p class="ans"><span>A.</span><span>レンタル版の場合エントリー時に銀行振込、口座自動振替、クレジットカードからお選びいただけます。<br>
                        また、月払いの他、年払い、半年払いにも対応しております。<br>
                        エントリー後でもお支払い方法の変更は可能ですので、気兼ねなくお申し付けください。<br>
                        尚、変更するお支払い方法によっては、再度ごエントリーや手続きが必要になる場合があります。<br>
                        ※App Store版「Soccer Plus」のお支払いにつきましては、Apple社の請求方法に準拠いたします。</span></p>
                </div>
            </div>
            <div class="accordionItem nonAccor">
                <p class="ques"><span>Q.</span><span>itunesカードでお支払いはできますか</span></p>
                <div>
                    <p class="ans"><span>A.</span><span>AppStore版「SoccerPlus」のみitunesカードでのお支払いが可能です。<br>
                        ご不明点などはAppleに直接お問い合わせをお願いいたします。</span></p>
                </div>
            </div>
            <div class="accordionItem nonAccor">
                <p class="ques"><span>Q.</span><span>アプリを削除したら、プレミアム版の機能が使えなくなりました</span></p>
                <div>
                    <p class="ans"><span>A.</span><span>アプリを削除してしまった場合は、営業担当及びサッカープラス事務局までご連絡ください。<br>
                        再インストールまでの手順をご案内致します。<br>
                        また、バックアップをお取りいただいている場合は、最終バックアップ時点まで復元が可能ですので、ご利用の際は随時バックアップの取得を推奨しております。<br>
                        ※アプリへログイン時に選択式の自動バックアップ機能を設けております。</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection