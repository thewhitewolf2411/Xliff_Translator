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

$(document).ready(function() {
    $('.find-us').click(function(){
        window.open('https://www.google.com/maps/place/SmartLab/@43.8542408,18.3870703,17z/data=!3m1!4b1!4m5!3m4!1s0x4758c8c48c458d13:0xd3b7b0136b05bfe5!8m2!3d43.854237!4d18.389259', '_blank');
    });

});


function mustLogin(){

    document.getElementById("must-login").style.display = "block";
    document.getElementById("login-email").textContent = "*E-mail Address";
    document.getElementById("login-email").style.color = "red";
    document.getElementById("login-password").textContent = "*Password";
    document.getElementById("login-password").style.color = "red";

}



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

//drag and drop
$(document).ready(function(){

    $(function () {
        var dropZoneId = "drop-zone";
        var buttonId = "clickHere";
        var mouseOverClass = "mouse-over";
    
        var dropZone = $("#" + dropZoneId);
        var ooleft = dropZone.offset().left;
        var ooright = dropZone.outerWidth() + ooleft;
        var ootop = dropZone.offset().top;
        var oobottom = dropZone.outerHeight() + ootop;
        var inputFile = dropZone.find("input");
        document.getElementById(dropZoneId).addEventListener("dragover", function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropZone.addClass(mouseOverClass);
            var x = e.pageX;
            var y = e.pageY;
    
            if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
                inputFile.offset({ top: y - 15, left: x - 100 });
            } else {
                inputFile.offset({ top: -400, left: -400 });
            }
    
        }, true);
    
        if (buttonId != "") {
            var clickZone = $("#" + buttonId);
    
            var oleft = clickZone.offset().left;
            var oright = clickZone.outerWidth() + oleft;
            var otop = clickZone.offset().top;
            var obottom = clickZone.outerHeight() + otop;
    
            $("#" + buttonId).mousemove(function (e) {
                var x = e.pageX;
                var y = e.pageY;
                if (!(x < oleft || x > oright || y < otop || y > obottom)) {
                    inputFile.offset({ top: y - 15, left: x - 160 });
                } else {
                    inputFile.offset({ top: -400, left: -400 });
                }
            });
        }
    
        document.getElementById(dropZoneId).addEventListener("drop", function (e) {
            $("#" + dropZoneId).removeClass(mouseOverClass);
        }, true);
    
    })

});
