$(document).ready(function() {

	$('#callBack #send_btn').on('click', function(){
		$(this).attr('disabled','disabled');
		checkCallBackForm();
		return false;
	});
	
	$('#callBack #callBackForm').submit(function(){
		checkCallBackForm();
		return false;
	});

    $("#callBack #slider-range").labeledslider({
      range: true,
      min: 10,
      max: 20,
	  step: 2,
	  tickInterval: 2,
	  tickLabels: {
          10:'10:00',
          12:'12:00',
          14:'14:00',
          16:'16:00',
          18:'18:00',
          20:'20:00',
        },
      values: [ 10, 20 ],
      slide: function( event, ui ) {
        $("#callBack #time").val( ui.values[ 0 ] + ":00 - " + ui.values[ 1 ] + ":00");
      }
    });
	
	$("#callBack #time").val($("#callBack #slider-range").labeledslider("values", 0) +
      ":00 - " + $("#callBack #slider-range").labeledslider("values", 1) + ":00"); 

	$("#callBack #phone").mask("+375 (29) 777-77-77");  
});

function openCallBackModal()
{
	$('#callBack').modal();
	return false;
};

function checkCallBackForm() 
{
	var fio = $('#callBack #fio'),
		phone = $('#callBack #phone'),
		error = 0;
	
	$('#callBack input').each(function() 
	{
			$(this).removeClass('error');
	});
	
	if(fio.val().length < 2) 
	{
		fio.addClass('error');
		error++;
	}
	
	if(phone.val().length < 2) 
	{
		phone.addClass('error');
		error++;
	}
	
	if ($("#email").length>0)
	{
		var email = $('#callBack #email'),
			patt = /^.+@.+[.].{2,}$/i; 
		if(!patt.test(email.val())) 
		{ 
			email.addClass('error'); 
			error++;
		}
	}	
		
	if(error == 0) 
	{
		$.ajax({
			type:'POST',
			url:$('#callBack #callBackForm').attr('action'),
			data:$('#callBack form').serialize(),
			beforeSend: function(){
				$('#callBack #send_btn').html('<img class="loader" src="/bitrix/components/wlcomponents/callback/templates/.default/img/loader.gif" />');
			},
			error: function(){
				alert('Connection error.');
				$('#callBack #send_btn').removeAttr('disabled');
			},
			success: function(data){
				
				var obj = jQuery.parseJSON(data);
	
				if($(obj.success).length > 0) {
					$('#callBack #send_btn').hide(); 
					$('#callBack #close_btn').show();
					$('#callBack .modal-body #form').slideUp(500, function(){
						$('#callBack .modal-body #thanks').slideDown(500);
					});  
				} else {
					alert('Connection error.'); 
					$('#callBack #send_btn').removeAttr('disabled');
				}
			}
		});
	} else 
		$('#callBack #send_btn').removeAttr('disabled');
};