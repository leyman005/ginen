$(window).scroll(function(){
	// var count = '';
	// var firstpage_height = $('#overlay');

	// var vert_scroll_position = $(window).scrollTop();

	// if(vert_scroll_position  >= 206 || vert_scroll_position ==100 )
	// {
	// 	alert('cool');
	// }
	// console.log(vert_scroll_position);
})

$(document).ready(function(){
	$('#shadow').find('p').each(function(index, value){
		$(this).click(function(){
			if(index == 1)
			{
				$(this).addClass('shad');
				$('#show').removeClass('shad');
				$('.card-section1').css({'box-shadow': 'none', 'transition' : 'all 1.5s ease'});
			}

			if(index == 0)
			{
				$(this).addClass('shad');
				$('#hide').removeClass('shad');
				$('.card-section1').css({'box-shadow': ' 0px 20px 50px #555', 'transition' : 'all 1.5s ease'});
			}
		})
	})
})

if($('#msg').text() != '')
{
	setTimeout(function(){
		$('#msg').fadeOut(1500);
	}, 3000);
}