$(function() {
	// 国名変更時に発火
	$('select[name="country"]').change(function() {
		
		// 選択した国のクラス名を取得
		var countyName = $('select[name="country"] option:selected').attr("class");
		console.log(countyName);
		
		// 都市名の要素数を取得
		var count = $('select[name="city"]').children().length;
		for (var i=0; i<count; i++) {
			
			var city = $('select[name="city"] option:eq(' + i + ')');
			
			if(city.attr("class") === countyName) {
				city.show();
			}else {
				city.hide();
			}
		}
	})
})