// ==============================================================
//
// COPYRIGHT(C) CYBRiDGE CORPORATION.
// URL:http://www.cybridge.jp/
//
// CB-STANDARD for HTML5
// --admin.js--
//
// 管理画面用スクリプト
//
// ==============================================================

(function($) {
	$(function() {

		// ==============================================================
		// 確認アラート
		// ==============================================================
		$(".confirm").click( function() {
			return confirm($(this).attr("data-alert"));
		});


		// ==============================================================
		// バリデーション FormValidator
		// ==============================================================
		if ($().validationEngine) {
			$("form").validationEngine();
		}


		// ==============================================================
		// jQuery UI カレンダー
		// ==============================================================
		if ($().datepicker) {
			$("input.datepicker").datepicker({
				dateFormat : "yy-mm-dd"
			});
		}

		if ($().datetimepicker) {
			$.datetimepicker.setLocale('ja');
			$(".datetimepicker").datetimepicker({
						format: "Y-m-d H:i",
						formatTime: "H:i",
						formatDate: "Y-m-d",
						setLocale: 'ja',
				});
		}


		// ==============================================================
		// Google Maps
		// ==============================================================
		if ($("#showGmap")[0]) {
			var map;
			var marker;
			var glat = 35.6960839; // 緯度
			var glng = 139.68941199999995; // 経度


			var myOptions = {
				zoom: 15,
				center: new google.maps.LatLng(glat,glng),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel:false
			};

			map = new google.maps.Map(document.getElementById("map"), myOptions);

			var location = new google.maps.LatLng(glat,glng);
			marker = new google.maps.Marker({
				position	: location,
				map			: map,
				draggable	: true
			});
				$("#mapLat").val(marker.getPosition().lat());
				$("#mapLng").val(marker.getPosition().lng());

			google.maps.event.addListener(marker, 'dragend', function() {
				map.panTo(marker.getPosition());
				$("#mapLat").val(marker.getPosition().lat());
				$("#mapLng").val(marker.getPosition().lng());
			});

			$("#showGmap").click(function () {
				searchMap($("#userAdd").val());
			});


			function searchMap(address){

				address=prompt("所在地を入力してください。",$("#userAdd").val());
				if(!address){
					return false;
				}
				geocoder = new google.maps.Geocoder();

				geocoder.geocode(
					{"address":address},
					function(results, status){
						if (status == google.maps.GeocoderStatus.OK) {
							map.setCenter(results[0].geometry.location);
							marker.setPosition(results[0].geometry.location);
							$("#mapLat").val(marker.getPosition().lat());
							$("#mapLng").val(marker.getPosition().lng());
						} else {
							alert("無効な住所です。");
						}
					}
				);
			}
		}
	});
})(jQuery);
