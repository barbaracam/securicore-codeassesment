//Validate with jquery sign up/login form

$(document).ready(function(){
    $("form").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }        
        },
        msg: { 
            username: {
                required: 'please provide an username'
            }, 
            password: {
                required: 'please provide a password'
            }  
        }
    })
})

//Validate with jquery to add data(userinfo.php)
$(document).ready(function(){
    $("#userinformation").validate({
        rules: {
            uname: {
                required: true
            },
            email: {
                required: true
            }        
        },
        msg: { 
            uname: {
                required: 'please provide an username'
            }, 
            email: {
                required: 'please provide a password'
            }  
        }
    })
})

