$("#show").click(function()
{
	$(this).css("display","none")
	$("#hide").css("display","inline")

	$("#pass").attr("type", "text")
})

$("#hide").click(function()
{
	$(this).css("display","none")
	$("#show").css("display","inline")

	$("#pass").attr("type", "password")
})

/** 
* Add user on click
*
* @author Manley Louis
*/   

$(".add").submit(function(){
	
	var that = $(this)
	method = that.attr('method')
	data = {}

	data["active"] = $("#select").val()

	that.find("input[name]").each(function()
	{
		var that = $(this)
		 	name = that.attr("name")
		 	value = that.val()

		data[name] = value
	})

	$.ajax({
		url: "../ajax/add_user.php",
		type: method,
		data: data,
		success: function(result)
		{
			if(result)
			{
				document.location.href='./user.php';
			}
		}
		
	})

	return false;
})

/** 
* Update user on click
*
* @author Manley Louis
*/   

$(".save").submit(function(){
	
	var that = $(this)
	method = that.attr('method')
	data = {}

	data["active"] = $("#select").val()

	that.find("input[name]").each(function()
	{
		var that = $(this)
		 	name = that.attr("name")
		 	value = that.val()

		data[name] = value
	})

	$.ajax({
		url: "../ajax/update_user.php",
		type: method,
		data: data,
		dataType: 'json',
		success: function(result)
		{
			if(result)
			{
				location.href='./user.php';
			}
		},
		error: function(result)
		{
			console.log(JSON.stringify(result));
		}
	})

	return false;
})



/** 
* Delete user on click
*
* @author Manley Louis
*/   

$('#del a:first-child').click(function(){

var confirmation = "<div id='dlg-del-confirm' title='Delete user'><p>Please confirm user deletion</p></div>";
$('table').after(confirmation);
var data = {};
var response = '';  
        
var id = $(this).attr('name');

data['id'] = id;


$('#dlg-del-confirm').dialog({
    modal:true,
    autoOpen: true,
    resizable: false,
    buttons: 
    {
        Yes: function()
        {
        
            $.ajax
            ({
                url: '../ajax/delete_user.php',
                type: 'post',
                data: data,
                success: function(result)
                {
                    document.location.href='./user.php';

                    $('#dlg-del-confirm').dialog("close");
                    $('#dlg-del-confirm').remove();
                }
            });   
        },
        No: function()
        {
            $('#dlg-del-confirm').dialog("close");
            $('#dlg-del-confirm').remove();
        }
    }
});

return false;
}); 

/** 
* select user datas on click
*
* @author Manley Louis
*/         

$("a[name=update_user]").click(function(){
	var user_id = $(this).attr('id')
	var data = {}

	data['id'] = user_id

	$.ajax({
		url: '../ajax/get_user.php',
		type: 'post',
		data: data,
		dataType: 'json',
		success: function(result)
		{
			$("#add").fadeOut("slow")
			$("#upt").fadeIn("slow")
	
			$("#first").val(result.firstname)
			$("#name").val(result.surname)
			$("#user").val(result.username)
			$("#email").val(result.email)
			$("#user_id").val(user_id)

		},
		error: function(result)
		{
			console.log(JSON.stringify(result));
		}
	})
	
	return false
})