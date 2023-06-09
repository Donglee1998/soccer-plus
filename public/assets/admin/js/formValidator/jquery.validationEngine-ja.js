(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = {"required":{
						"regex":"none",
						"alertText":"必須項目です",
						"alertTextCheckboxMultiple":"複数選択必須です",
						"alertTextCheckboxe":"選択必須です"},
					"length":{
						"regex":"none",
						"alertText":"文字数は ",
						"alertText2":" 〜 ",
						"alertText3":" 文字までです"},
					"maxCheckbox":{
						"regex":"none",
						"alertText":"チェックが多すぎます"},
					"minCheckbox":{
						"regex":"none",
						"alertText":"",
						"alertText2":" 個以上チェックしてください"},
					"confirm":{
						"regex":"none",
						"alertText":"内容が一致しません"},
					"telephone":{
						"regex":"/^[0-9\-\(\)\ ]+$/",
						"alertText":"電話番号が不正です"},
					"zip":{
						"regex":"/^[0-9]{3}\-[0-9]{4}$/",
						"alertText":"郵便番号が不正です"},
                    "zipcode":{
                        "regex":"/^([0-9]{7})$/",
                        "alertText":"郵便番号が不正です"},
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"メールアドレスが不正です"},
					"url":{
						"regex":"/^https?:\/\//",
						"alertText":"URLが不正です"},
					"date":{
						"regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
						"alertText":"日付は YYYY-MM-DD の書式にしてください"},
 					"time":{
 						"regex":"/^[0-9]{2}:[0-9]{2}/",
 						"alertText":"時間は HH:iiもしくはHH:ii:ss の書式にしてください"},
					"onlyNumber":{
						"regex":"/^[0-9\ ]+$/",
						"alertText":"数字のみ入力してください"},
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z]+$/",
						"alertText":"特殊文字は使用できません"},
					"name":{
						"regex":"/^.*?( |　).*?$/",
						"alertText":"姓と名の間にスペースを入力してください。"},
					"ajaxUser":{
						"file":"validateUser.php",
						"extraData":"name=eric",
						"alertTextOk":"ok",
						"alertTextLoad":"使用可能かどうか確認中...",
						"alertText":"ユーザー名はもう使われています"},
					"ajaxName":{
						"file":"validateUser.php",
						"alertText":"この名前はもう使われています",
						"alertTextOk":"ok",
						"alertTextLoad":"使用可能かどうか確認中..."},
					"onlyLetter":{
						"regex":"/^[a-zA-Z0-9\ \']+$/",
						"alertText":"英数字のみ入力してください"},
					"onlyLetter2":{
						"regex":"/^[a-zA-Z0-9_\-]+$/",
						"alertText":"英数字とハイフン、アンダーバーのみで入力してください"},
					"	":{
						"regex":"/^[0-9]+$/",
						"alertText":"有効期限を選択してください"},
				}
		}
	}
  $(document).ready(function() {
    $.validationEngineLanguage.newLang()
  });
})(jQuery);
