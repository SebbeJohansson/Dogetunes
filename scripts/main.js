$(document).ready(function(){
	$(".sellercheckbox").on("click",function(){
		if ($(this).hasClass("highlighted")) {
		    $(this).removeClass("highlighted");
                    //$(".sellmusic").hide();
		    $(".sellercheckbox").parent().find("#tiles").find(".notselling").show();
                        
		}else{
		    $(this).addClass("highlighted");
		    $(".sellercheckbox").parent().find("#tiles").find(".notselling").hide();
		}
	});
});