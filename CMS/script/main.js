$('form.ajax').on('submit', function(){
	var that = $(this), 
		url = that.attr('action'),
		type = that.attr('method'),
		data = {};

		that.find('[name]').each(function(index, value){
			var that = $(this),
				name = that.attr('name'),
				value = that.val();

				data[name] = value;
		});

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				alert(response);
			}
		});

	return false;
});
$(document).ready(function(){
	$('input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed check ', function(event){                
        if(event.type ==="ifChecked"){
            $(this).trigger('click');  
            $('input').iCheck('update');
            var checkbox =  $(this).attr('class');
            $.ajax({
				url: "http://dogetunes.tytos.se/CMS/includes/doSendStatus.php",
				type: "POST",
				data: {id: checkbox, value: true},
			});
        }
        if(event.type ==="ifUnchecked"){
            $(this).trigger('click');  
            $('input').iCheck('update');
            var checkbox =  $(this).attr('class');
            $.ajax({
				url: "http://dogetunes.tytos.se/CMS/includes/doSendStatus.php",
				type: "POST",
				data: {id: checkbox, value: false},
			});
        }                                      
	});
});
$(document).ready(function(){
	$('input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed check ', function(event){                
        if(event.type ==="ifChecked"){
            $(this).trigger('click');  
            $('input').iCheck('update');
            var checkbox =  $(this).attr('id');
            $.ajax({
		url: "http://dogetunes.tytos.se/CMS/includes/doSendStatusTut.php",
		type: "POST",
		data: {id: checkbox, value: true},
		});
        }
        if(event.type ==="ifUnchecked"){
            $(this).trigger('click');  
            $('input').iCheck('update');
            var checkbox =  $(this).attr('id');
            $.ajax({
				url: "http://dogetunes.tytos.se/CMS/includes/doSendStatusTut.php",
				type: "POST",
				data: {id: checkbox, value: false},
			});
        }                                      
	});
});

$(document).ready(function(){
	$(".sellcheckbox").on("click",function(){
		if ($(this).hasClass("highlighted")) {
			$(this).find("label").text("Enable Selling");
			$(this).removeClass("highlighted");
			$(".sellmusic").hide();
			$("#merchant").attr("value","");
		}else{
			$(this).find("label").text("Disable Selling");
			$(this).addClass("highlighted");
			$(".sellmusic").show();
		}
	});
});
$(document).ready(function(){
	$(".soundcloudcheckbox").on("click",function(){
		if ($(this).hasClass("highlighted")) {
			$(this).find("label").text("Enable SoundCloud");
			$(this).removeClass("highlighted");
			$(".soundcloud").hide();
			$("#soundcloudid").attr("value","");
		}else{
			$(this).find("label").text("Disable SoundCloud");
			$(this).addClass("highlighted");
			$(".soundcloud").show();
		}
	});
});


function changeOrder(to,order,id){

    if(to == 'up'){
        document.location.href="includes/changeOrder.php?act=changeup&orderID="+order+"&aid="+id;
    }else if(to == 'down'){
        document.location.href="includes/changeOrder.php?act=changedown&orderID="+order+"&aid="+id;
    }   
    
}
function changeTutOrder(to,order,id,cat_name)
{
    if(to == 'up'){
        document.location.href="includes/changeTutOrder.php?cat="+cat_name+"&act=changeup&orderID="+order+"&aid="+id;
    }else if(to == 'down'){
        document.location.href="includes/changeTutOrder.php?cat="+cat_name+"&act=changedown&orderID="+order+"&aid="+id;
    }   
    
}

