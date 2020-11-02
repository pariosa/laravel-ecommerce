
$(document).ready(function(){
    const passwordField = $("#updateAdminForm").find("#password");  
    let inputHasChanged = false;
    passwordField.keyup(function(){
        $("#chkCurrentPwd").html("<font color=orange>validating...</font>");
        setTimeout(function(){
            inputHasChanged = true;
        },1000);
    });
    passwordField.blur(function(){
        $("#chkCurrentPwd").html("<font color=orange>validating...</font>");
        setTimeout(function(){
            inputHasChanged = true;
        },1000);
    });
    passwordField.keyup(function(){       
        if(inputHasChanged === true){
            setTimeout(function(){
                    ajaxPwReq(passwordField);
                    inputHasChanged = false;
                
            },500);
    }
    });
    passwordField.blur(function(){
        if(inputHasChanged === true){
            setTimeout(function(){
                    ajaxPwReq(passwordField);
                    inputHasChanged = false;
            },500);
    }
    });
})

function ajaxPwReq(passwordField){ 
    const password = passwordField.val(); 
    $.ajax({
        type:'post',
        url:'/admin/check-current-password',
        
        data:{
            password:password,
            "_token": $('meta[name="csrf-token"]').attr('content')
           },
        success:function(resp){  
           if(resp=="false"){
               $("#chkCurrentPwd").html("<font color=red>Current Password is incorrect</font>");
           }else if(resp=="true"){
               $("#chkCurrentPwd").html("<font color=green>Current Password is correct</font>");
           }
        },error:function(){
         //alert("Error");
        }
    });
}