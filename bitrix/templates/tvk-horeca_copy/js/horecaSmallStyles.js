$(document).ready(function() {
	//alert("jquery");
	function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ')
				c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) 
				return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

	if(readCookie("window_width") <= 1280)
	{
		$("#vertical-menu + pre").hide();
		$("#vertical-menu + pre + p").hide();
		$(".tvk-catalog-section > table").css("border", "1px solid green");
		$(".tvk-catalog-section").css("font", "14pt/125% HattoriHanzo,Arial;");
			//alert($(".tvk-catalog-section > table")[0].clientWidth);
		//alert(window.location.href);
		if(window.location.href.toString().indexOf("company") > -1)
		{
			$("#r-col table").css("font-size", "14px");
		}
	}
	if(navigator.userAgent.indexOf("MSIE") > -1 && readCookie("window_width") <= 1280)
	{
		//alert(readCookie("window_width"));
		$("#targets table img").css("height", "70px");
		$("#horizontal-multilevel-menu").css("font-size", "14px");
		$(".tvk-catalog-section > table").css("border", "1px solid green");
	}
});