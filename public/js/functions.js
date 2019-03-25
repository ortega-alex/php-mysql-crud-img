var cr;

$(function(){ 
	$('#target-user').Jcrop({
		onSelect: showCoords
	});
	getPosition();
});

function showCoords(c)
{
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

function fntSaveImg(id , src , nombres , apellidos , dpi){
	
	if(cr) {

		var data = {
			des_w : $('#target-origin').width(),
			src_w : $("#target-user").width(),
			x : cr.x ,
			y : cr.y ,
			src ,
			id ,
			nombres ,
			apellidos ,
			dpi
		};

		console.log(data);

		$.ajax({
			url: "controller.php?save=true",
			type: "POST",
			dataType: "json",
			data: data,
			success: function(res) {
				if (res.err == "false") {
					swal({   
                        title: "Success",   
                        text: res.msn,   
                        type: "success",
                        confirmButtonColor: "#DD6B55"   
                    },
					function(isConfirm) {
					  if (isConfirm) {
					   	 location.reload();
					  }
					});  
				} else {
					swal({   
                        title: "warning",   
                        text: res.msn,   
                        type: "warning",
                        confirmButtonColor: "#DD6B55"  
                    }); 
				}	
			}
		});
	} else {
		swal({   
            title: "warning",   
            text: "seleccione las cordenadas de la imagen!.",   
            type: "warning",
            confirmButtonColor: "#DD6B55"  
        }); 
	}
}
