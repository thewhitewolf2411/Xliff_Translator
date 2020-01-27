function changeInputText(){

    var ortext = document.getElementById('orxlftext');
    var image = document.getElementById('browsexlfsvg');

    ortext.style.opacity = 0;
    image.style.opacity = 0;

    document.getElementById('uploadtext-xlf').innerHTML = document.getElementById('xlfupload').value;

}

function changeInputTextXLS(){
    var ortext = document.getElementById('orxlstext');
    var image = document.getElementById('browsexlssvg');

    ortext.style.opacity = 0;
    image.style.opacity = 0;

    document.getElementById('uploadtext-xls').innerHTML = document.getElementById('xlsupload').value;

}

function scrollToTranslate(){
        document.querySelector('#right-half').scrollIntoView({behavior: 'smooth'});
}