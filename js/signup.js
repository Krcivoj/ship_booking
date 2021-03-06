let nname = false;
let surname = false;
let email = false;
let password = false;
let repeatPassword = false;

$("#name").on('input', function(){
    nname =  $(this).val().match(/^[a-zA-Z-' ]{1,50}$/) !== null;
    if(!nname)
        $(this).css('border', '1px solid red');
    else {
        $(this).css('border', 'none');
        $(this).css('border-bottom', '1px solid #999');
    }
});

$("#surname").on('input', function(){
    surname =  $(this).val().match(/^[a-zA-Z-' ]{1,50}$/) !== null;
    if(!surname)
        $(this).css('border', '1px solid red');
    else {
        $(this).css('border', 'none');
        $(this).css('border-bottom', '1px solid #999');
    }
});

$("#email").on('input', function(){
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    email = re.test($(this).val());
    if(!email)
        $(this).css('border', '1px solid red');
    else{
        $(this).css('border', 'none');
        $(this).css('border-bottom', '1px solid #999');
   }
});

$("#password").on('input', function(){
    re = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]{8,})$/
    password =  re.test($(this).val());
    if(!password)
        $(this).css('border', '1px solid red');
    else{
        $(this).css('border', 'none');
        $(this).css('border-bottom', '1px solid #999');
    }
});

$("#repeatPassword").on('input', function(){
    repeatPassword =  ($(this).val() === $("#password").val());
    if(!repeatPassword)
        $(this).css('border', '1px solid red');
    else {
        $(this).css('border', 'none');
        $(this).css('border-bottom', '1px solid #999');
    }
});

function checkInput(){
    let ans = !(nname && surname && email && password && repeatPassword);
    $('#btn'). attr("disabled", ans);
    id=setTimeout(checkInput, 100)
}
checkInput();