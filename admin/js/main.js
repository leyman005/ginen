$(function(){

	$('#txtusername').focus();
	var url = window.location.href; 
});


$('form').submit(function(e){
	e.preventDefault();

	var that = $(this);

	var url = that.attr('action');

	var method = that.attr('method');

	var data = {};

	// Checking from which location this main.js script has been called (if from ginen.co.za don't run ajax script)

	callAjax = url.includes('ajax') == false ? false : true;

	that.find('input[name]').each(function(index, value){
		var that = $(this);

		if(that.val() == '')
		{
			var getLabelText = url.includes('ajax') == false ? $(value).attr('placeholder') : $(value).prev().prev().text();

			// remove column from lael text
			getLabelText = getLabelText.slice(0, -1);

			$('#bar').before('<div id="msg" class="danger"></div>');
			$('#msg').text(getLabelText+' is required');
			$('#msg').fadeIn(1500);

			setTimeout(function(){
				$('#msg').fadeOut(1500);
			},3000);

			$('#msg').fadeIn(1500);
			$('msg').text('');

			callAjax = false;
			
			return false;
		}
		
		data[that.attr('name')] = that.val();
		
	});
	
	if(callAjax == false)
	{
		$('form').unbind('submit').submit();
	}

	if(callAjax == true)
	{
		$.ajax({
			url: url,
			type : method,
			data : data,
			dataType: "json",
			success : function(result)
			{  
				if(result.error === true)
				{
					$('#bar').before('<div id="msg" class="danger"></div>');
					$('.danger').text('Wrong Username or Password');


					$('#msg').fadeIn(900);
					setTimeout(function(){
						$('.danger').fadeOut(900);
					},1000);
					return;
				}

				if(result.hasOwnProperty('success'))
				{
					$('#bar').before('<div id="msg" class="success"></div>');
					$('.success').text(result.success);
			
					$('.success').fadeIn(900);
					setTimeout(function(){
						$('.success').fadeOut(900);
					},1000);

					setTimeout(function(){
						location.href='system/dashboard.php';
					}, 1500);	
				} 
			},
			error : function(result)
			{
				console.log(JSON.stringify(result));
			}
		});
	}

});
var first_click = true;

$('.bar-wrap').click(function(){
	

	if(first_click == true)
	{
		$('#bar2').fadeOut(1500);

		$('#bar1').css({'transform':'rotate(45deg)', 'transition':'all 2s linear', 'top':'30px'});

		$('#bar3').css({'transform':'rotate(-45deg)', 'transition':'all 2s linear', 'top': '30px'});

		// $('.nav ul').fadeIn(1500);

		$('.line').fadeOut(1500);

		// $('nav ul').removeClass('navbar');

		$('nav ul').toggleClass('show');
	
		first_click = false;
	}
	else
	{
		$('nav ul').toggleClass('show');

		// $('nav ul').addClass('navbar');

		$('.line').fadeIn(1500);

		$('#bar2').fadeIn(1500);

		$('#bar1').css({'transform':'rotate(0deg)', 'transition':'all 2s linear', 'top':'10px'});

		$('#bar3').css({'transform':'rotate(-0deg)', 'transition':'all 2s linear', 'top': '30px'});

		first_click = true;
	}

});