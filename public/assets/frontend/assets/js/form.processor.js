$(function () {    
        
    //Process Forms  
    processForm($("#process-form"),$("#submit-form"));
    //process-form-upload
    uploadFile($("#upload-photo"));
    //delete links
    deleteLink($("#delete"));
    //preview Images
    imagePreview($("#file"),$('.profile-dp'));
    ////preview Images
    imagePreview($("#galleryfile"),$('.gallery-photo'));

    
    function imagePreview(fileInput,preview)
    {
        fileInput.change(function () {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    }
    function deleteLink(link)
    {
        link.click(function(e){  
            e.preventDefault();  
            var deleteLink = $(this).attr("href")   
            swal({
                title: "Are you sure?",
                text: "This action can not be undone",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4611a7",
                confirmButtonText: "Yes, delete it!"
            },
            function(){            
                window.location.href= deleteLink; 
            });
        });
    }    
    function processForm(submittedForm,formButton,log=false) {
        //enable log=true for debugging   
        formButton.click(function () {
            formButton.attr('disabled', 'disabled');            
            var dataBundle = submittedForm.serialize()+"&&mode=app";  
            $.ajax({
                url : submittedForm.attr("action"),
                type: "POST",
                data : dataBundle,
                dataType: "json",
                success: function(data, textStatus, jqXHR)
                {
                    formButton.removeAttr("disabled");                 
                    if (log) { console.log(data);/*logging reply*/ }                    
                    if (!data.error)
                        {              
                            swal("Success", data.message, "success");
                            if (data.reset){ submittedForm[0].reset();}
                        } else
                        {
                            swal("Oops",data.message, "error");
                        }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {   
                    formButton.removeAttr("disabled");  
                    console.log(textStatus);
                    console.log(errorThrown);          
                    swal("Oops","Error processing form.please try again", "error");
                }
            });

        });
    }
    function uploadFile(submittedForm)
    {       
        submittedForm.on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url : submittedForm.attr("action"),
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                    cache: false,
                processData:false,
                beforeSend : function() { },
                success: function(data)
                    {
                        var data = JSON.parse(data); 
                        if (!data.error)
                        {              
                            swal("Success", data.message, "success");
                            if (data.reset){ location.reload(); }
                        } else
                        {
                            swal("Oops",data.message, "error");
                        }
                    },
                error: function(e){ swal("Oops","Error processing form.please try again", "error"); }          
              });
           }));
    }
});
