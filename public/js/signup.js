function changeSiteLanguage(value) {
    document.getElementById("languageForm").submit(value);
 }
 

 function playvideo() {

    console.log("");


 }

 function changeDisplayToReg(){

    document.getElementById("login-page").style="display:none";
    document.getElementById("login-page").required="false";
    document.getElementById("registration-page").style="display:block";
    document.getElementById("registration-page").required="true";

    document.getElementById("reg-button").classList.add('active');
    document.getElementById("log-button").classList.remove('active');
}

function changeDisplayToLog(){

    document.getElementById("registration-page").style="display:none";
    document.getElementById("registration-page").required="false";
    document.getElementById("login-page").style="display:block";
    document.getElementById("login-page").required="true";

    document.getElementById("log-button").classList.add('active');
    document.getElementById("reg-button").classList.remove('active');
}



var input = $(".input");
input.focusin(function() {
    $(this).addClass("input-active");
});
input.focusout(function() {
    $(this).removeClass("input-active");
});

$(document).ready(function() {
    $('.find-us').click(function(){
        window.open('https://www.google.com/maps/place/SmartLab/@43.8542408,18.3870703,17z/data=!3m1!4b1!4m5!3m4!1s0x4758c8c48c458d13:0xd3b7b0136b05bfe5!8m2!3d43.854237!4d18.389259', '_blank');
    });

});


function mustLogin(){

    document.getElementById("must-login").style.display = "block";
    document.getElementById("must-register").style.display = "block";
    document.getElementById("login-email").textContent = "*E-mail Address";
    document.getElementById("login-email").style.color = "red";
    document.getElementById("login-password").textContent = "*Password";
    document.getElementById("login-password").style.color = "red";

    document.getElementById('log-button').scrollIntoView()

    event.preventDefault();

}

function changeSiteLanguage(value) {
    document.getElementById('languageForm').submit();
}

window.onmousedown = function (e) {
    var el = e.target;
    if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
        e.preventDefault();

        // toggle selection
        if (el.hasAttribute('selected')) el.removeAttribute('selected');
        else el.setAttribute('selected', '');
    }
}

$(document).ready(function() {
    


    if($(".error-message-registration").text() == ""){

        console.log('default');
        return;

    } else {

        if($(".error-message-registration").text() == "The password must be at least 8 characters."){

            changeDisplayToReg();
            $("#login-error-email").hide();
            $("#login-error-password").hide();
            return;
        }

        if($(".error-message-registration").text() == "The email has already been taken."){

            changeDisplayToReg();
            $("#login-error-email").hide();
            $("#login-error-password").hide();
            return;
        }

        if($(".error-message-registration").text() == "These credentials do not match our records."){
            
            changeDisplayToLog();
            $("#registration-error-email").hide();
            $("#registration-error-password").hide();
            return;
        }


    }

});