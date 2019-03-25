var cr;

$(function(){ 
	$('#target-user').Jcrop({
		onSelect: showCoords
	});
	getPosition();
});

function showCoords(c)
{
	console.log(c);
	console.log($('#target-user').width());
	console.log("  " , $('#target-origin').width());
	cr = c;
};

function getPosition(){
	var po = $("#target-origin").position();
	console.log(po);
	$("#recorte").css({
		top: po.top + 31,
		left: po.left + 366,
		position: "absolute",
		background: "white"
	});
}

function aplearImg(strName){
	$.ajax({
		url: "controller.php?aplear=true&name=" + strName,
		success: function(res) {
			console.log(res);
			//location.reload();			
		}
	});
}

function recortarImg(strName){
	if ( cr ) {
		
		cr.name = strName;

		$.ajax({
			url: "controller.php?recortar=true",
			type: "POST",
			dataType: "json",
			data: cr,
			success: function(res) {
				console.log(res);
			}
		});
	} else {
		alert("seleccione cordenadas");
	}	
}

function fntSaveImg(){
	console.log(cr);
	$.ajax({
		url: "controller.php?save=true",
		type: "POST",
		dataType: "json",
		data: cr,
		success: function(res) {
			console.log(res);
		}
	});
}
