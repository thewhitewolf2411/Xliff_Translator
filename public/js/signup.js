function changeSiteLanguage(value) {
    document.getElementById("languageForm").submit();
 }
 

 function playvideo() {

    console.log("sranje");


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

var sub = $(".submit");
sub.hover(function(){
    $(this).addClass("hoover");
}, function(){
    $(this).removeClass("hoover");
});

$(document).ready(function(){
    
    $("#upload-btn").hover(function(){
        $(this).addClass("upload-btn-hover");
    }, function(){
        $(this).removeClass("upload-btn-hover");
    });

})

$(document).ready(function() {
    $('.find-us').click(function(){
        window.open('https://www.google.com/maps/place/SmartLab/@43.8542408,18.3870703,17z/data=!3m1!4b1!4m5!3m4!1s0x4758c8c48c458d13:0xd3b7b0136b05bfe5!8m2!3d43.854237!4d18.389259', '_blank');
    });
});
$(document).ready(function(){
    $("#upload-btn").click(function(){
        $('html, body').animate({
            scrollTop: $("#log-button").offset().top
        }, 800);
    });
});


window.onmousedown = function (e) {
    var el = e.target;
    if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
        e.preventDefault();

        // toggle selection
        if (el.hasAttribute('selected')) el.removeAttribute('selected');
        else el.setAttribute('selected', '');

        // hack to correct buggy behavior
        var select = el.parentNode.cloneNode(true);
        el.parentNode.parentNode.replaceChild(select, el.parentNode);
    }
}