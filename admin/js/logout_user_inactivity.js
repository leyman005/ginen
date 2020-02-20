function timeChecker()
{
	setInterval(function(){
		var storedTimeStamp = sessionStorage.getItem('time_stamp');
		timeComparaison(storedTimeStamp);
		
	}, 3000);
}


function timeComparaison(timeStr)
{
	// get stored time stamp and compare it with current time

	var currentTime = new Date();
	var pastTime   = new Date(timeStr);
	var diffTime   = currentTime - pastTime;
	var minPast    = Math.floor(diffTime/60000);

	if(minPast >= 15)
	{
		sessionStorage.removeItem('time_stamp');
		document.location.href="../logout.php";
		return;
	}
}

$(function(){
	$(document).mouseover(function(){

		// store time stamp
		var timeStamp = new Date();
		sessionStorage.setItem("time_stamp", timeStamp);
	});

	// if(storedTimeStamp) timeChecker();
});
