$(document).ready(function(){
	if($('.dyn_mp_jqm').length)
	{
		var jqmBlock = $('.dyn_mp_jqm'),
			delay = 0;

		if(!jqmBlock.hasClass('initied')) // first load
		{
			jqmBlock.addClass('initied');
			
			if(jqmBlock.data('param-delay'))
				delay = jqmBlock.data('param-delay')*1000;

			if(typeof localStorage !== 'undefined')
			{
				var dataLS = localStorage.getItem(jqmBlock.data('ls')),
					ls = '';
				try{
					ls = JSON.parse(dataLS);
				}
				catch(e){
					ls = dataLS
				}
				if(!ls || (ls && (ls.TIMESTAMP < Date.now())))
				{
					setTimeout(function(){
						jqmBlock.click();
					}, delay);
				}
			}
			else
			{
				var ls = $.cookie(jqmBlock.data('ls'));
				if(!ls)
				{
					setTimeout(function(){
						jqmBlock.click();
					}, delay);
				}
			}

		}
		else // ajax popup
		{
			
		}
	}
})