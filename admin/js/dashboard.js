
$(document).ready(function(){	

	$.ajax({
		url: '../ajax/dashboard.php',
		type : 'post',
		dataType: "json",
		success : function(result)
		{
			if(result.hasOwnProperty('NumberOfUsers'))
			{	
				var span = "<span class='count'>"+result.NumberOfUsers+"</span>";		
				$("#users").append(span);
			}
		},
		error : function(response)
		{
			console.log('error :' + JSON.stringify(response));
		}
	});


	var total = 0 
	var span = "<span class='countvisitors'> "+total+" Users</span>";	
	$("#visitors").append(span)	

	// setInterval(function(){

	$.ajax({
		url: '../ajax/count_visitor.php',
		type : 'post',
		async: false,
		dataType: "json",
		success : function(result)
		{
			if(result.hasOwnProperty('NumberOfVisitors'))
			{	
				total = result.NumberOfVisitors;
			}
		},
		error : function(response)
		{
			console.log('error :' + JSON.stringify(response));
		}
	});
	$(".countvisitors").text(total + " Users")
	$("#visitors").next().children().css("width",total + "%")
	// }, 120000)	
})

$('#myRange').on('input', function(){
	var that = $(this)

	that.css('transition', 'all 0.8s linear');

	$('#quotation').css('width', that.val()+'%');
	$('#quotation').css('transition', 'width 0.8s linear');

});

function timeChecker()
{
	setInterval(function(){
		var storedTimeStamp = sessionStorage.getItem('time_stamp');
		timeComparaison(storedTimeStamp);
		
	}, 3000);
}