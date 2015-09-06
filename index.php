<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    
	$("button").click(function(){
		$("#dataArea").show();
		
        $.get("data.php?action=getComment", function(data, status){
			if(status=='success'){
				$("#dataArea").html(data);	
			}
			
        });
    });
	//---- event to save chat text/ comment to server 
	$("#send").click(function(){
		var com_text=$("#com_text").val();						  		$.get("data.php?action=saveChat&com_text="+com_text, function(data, status){
			if(status=='success'){
				document.getElementById('com_text').value='';
				$('#dataArea').show();
				//--- to load data into chat history ---
				$.get("data.php?action=loadChat", function(data, status){
					$("#dataArea").html(data);															  				});
			}
		});
	});
	
	setInterval(function(){
		$.get("data.php?action=loadChat", function(data, status){
			$("#dataArea").show();
			$("#dataArea").html(data);															  		});				 
	}, 3000);
	
	
});

function onTestChange() {
	var key = window.event.keyCode;

	// If the user has pressed enter
	if (key == 13) {
		$( "#send" ).trigger( "click" );
		return false;
	}
	else {
		return true;
	}
}
</script>

</head>
<body>
Submit Form by Get Method<br>
<textarea name="textarea" id="com_text" cols="45" rows="5" placeholder="Comment here ..." onkeypress="onTestChange();"></textarea>
<br>
<input type="button" id="send" value=" Send ">
<hr>
<div id="dataArea" style="display:none;"><img src="loading_spinner.gif" width="200" height="200"></div>

</body>
</html>
