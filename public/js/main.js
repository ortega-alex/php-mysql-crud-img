function setUpload(){
    var formData = new FormData(document.getElementById("uploadform"));
    formData.append("dato", "valor");
	$.ajax({
        url: 'controller.php?set=true',
        async: true,
        type: "POST",
        dataType : "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(res){
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
}