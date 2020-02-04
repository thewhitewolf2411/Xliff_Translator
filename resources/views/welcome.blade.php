
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='node_modules/dm-file-uploader/src/js/jquery.dm-uploader.js'></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/signup_v2.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}" />
        <title>Xliff translator</title>
    </head>

    <style>
    #registration-page {

        display:none;
    }
    </style>

    <body>
    <div id="image-container">
        <img class="backgroundsvg" src="{{ asset('ass/new_ass/SmartLab-Webshape01.svg') }}" >
    </div>
    <header id="head">
    
       
        <div id="text"> 
            <p id="contact-top">Call: </p> <p id="contact-top"> <a href="tel: 00387 61 811 394" style="color:#999ca1;">+387 61 811 394</a></p> <p id="contact-top"><a href="tel: 00387 33 956 222" style="color:#999ca1;">+387 33 956 222 </a></p>
        </div>
            
            <form id="languageForm" action="/language" method="POST" >
            <!-- Form for sending new language after user clicks on one of the select options - page is refreshed with new language translations -->
            @csrf
            @method('PUT')

            <input type="radio" class="language" name="language" id="en" value="en" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='en' ) checked @endif><label for="en" @if(App::getlocale()=='en' ) class="language-selected" @endif>@lang('menu.english_language')</label>
           <input type="radio" class="language" name="language" id="de" value="de" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='de' ) checked @endif><label for="de" @if(App::getlocale()=='de' ) class="language-selected" @endif>@lang('menu.german_language')</label>
           <input type="radio"  class="language"name="language" id="bs" value="bs" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='bs' ) checked @endif><label for="bs" @if(App::getlocale()=='bs' ) class="language-selected" @endif>@lang('menu.bosnian_language')</label>

            </form>
        
    </header> 
    
    <div id="meni-div">

        <div id="meni-text">
            <p id="xls-title"><strong>xls2xlf</strong></p>
            <img id="logosvg" src="{{ asset('ass/smartlab-logo.svg') }}" >
            <div class="nav-button-inner" id="nav-button-inner"></div>
            <div class="nav-button-inner-before" id="nav-button-inner-before"></div>
            <div class="nav-button-inner-after" id="nav-button-inner-after"></div>
        </div>
        <div class="nav-li-container" id="nav-li-container">
            <li class="nav-li nav-li-js arrow first">
                <a class="grey" id="whatWeDo">@lang('menu.first_item')</a>
                <div class="filler"></div>
                <div class="expandable expandable-first">
                    <a href="https://smartlab.ba/pages/courses">@lang('menu.online_courses')</a>
                    <a href="https://smartlab.ba/pages/animations">@lang('menu.educational_video')</a>
                    <a href="https://smartlab.ba/pages/programming">@lang('menu.programming')</a>
                    <a href="https://smartlab.ba/pages/moodle">@lang('menu.moodle')</a>
                </div>
            </li>

            <li class="nav-li nav-li-js arrow">
                <a class="grey">@lang('menu.second_item')</a>
                <div class="filler"></div>
                <div class="expandable expandable-second">
                    <a href="https://smartlab.ba/#about" class="same-page-link">@lang('menu.about_us')</a>
                    <a href="https://smartlab.ba/#team" class="same-page-link">@lang('menu.our_team')</a>
                </div>
            </li>
            <li class="nav-li nav-li-js arrow">
                <a class="grey">@lang('menu.third_item')</a>
                <div class="filler"></div>
                <div class="expandable join expandable-third">
                    <div class="join-left">
                        <a href="https://smartlab.ba/pages/outsourcing">@lang('menu.outsourcing')</a>
                    </div>
                    <div class="join-right">
                        <a href="https://smartlab.ba/pages/partner">@lang('menu.become_a_partner')</a>
                        <a href="https://smartlab.ba/pages/careers">@lang('menu.careers')</a>
                    </div>
                </div>
            </li>
            <li class="nav-li nav-li-js">
                <!-- Open link in new tab and set its language depending on the current language in main website -->
                <a class="padding-right-0 grey" href="https://blog.smartlab.ba/en" @if(App::getlocale()){{App::getlocale()}}@else en @endif" target="_blank" rel="noopener">@lang('menu.fourth_item')</a>
            </li>
            <li class="nav-li nav-li-js last same-page-link"><a class="padding-right-0 grey" href="https://smartlab.ba/#contact">@lang('menu.fifth_item')</a></li>

            <!-- This menu items are available only to logged in users -->
            @auth

            <!-- not available for xlf users -->
            @if(\Illuminate\Support\Facades\Auth::user()->roles_id != 3)

            @endif


            @endauth
            <div class="nav-top-mobile">

                <p><span>Call: </span><span>+387 61 811 394</span> <span class="margin-right">+387 33 956 222</span></p>
                <form action="/language" method="POST" class="mobile-language-form">
                    <!-- Form for sending new language after user clicks on one of the select options - page is refreshed with new language translations -->
                    @csrf
                    @method('PUT')

                    <input type="radio" name="language" id="en" value="en" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='en' ) checked @endif><label for="en" @if(App::getlocale()=='en' ) class="language-selected" @endif>@lang('menu.english_language')</label>
                    <input type="radio" name="language" id="de" value="de" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='de' ) checked @endif><label for="de" @if(App::getlocale()=='de' ) class="language-selected" @endif>@lang('menu.german_language')</label>
                    <input type="radio" name="language" id="bs" value="bs" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='bs' ) checked @endif><label for="bs" @if(App::getlocale()=='bs' ) class="language-selected" @endif>@lang('menu.bosnian_language')</label>

                </form>

            </div>
        </div>
    </div>

    <div id="row-div">
        <div id="title-container">
            <h2 id="titlediv"><strong>Articulate Storyline <br> automatic text translation.</strong></h2>
            <p id="xls-title">xls2xlf converter</p>
        </div>
        <div id="title-div-container">
            <p id="subtext-regular"><strong id="subtext-bold">Find out More:</strong> <br> Xliff Articulate Translation Tool Tutorial.</p> 
            <img id="playvideobtn" src= "{{ asset('ass/play-button.svg') }}" onclick="playvideo()">
        </div>

    </div>
       
    <div id="text-sigup">
        <div id="text-content">
            <p id="text-content-p">If you are working on an Articulate Storyline project which should be translated in different languages, then we have a solution which can do that work for you. We developed an App which can: <br><br> </p>
            <ul id="list-main">
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;Import your original XLIFF file exported from your Articulate project <br><br> </li>
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;Generate Excel spreadsheet prepared for inserting translated text <br><br> </li>
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;Compare original XLIFF will uploaded translations <br><br> </li>
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;Engaging tools for webinars <br><br> </li>
                <p><strong>Provide you translated XLIFF in all languages you need so you can import them in your Articulate file and all texts should be translated in new languages without any format change or design.</strong><br><br> </p>
            </ul> 
        </div>
    
    @if(!Auth::user())
    <div id="action-div">
        <div id="button-cont">
        
            <button id="reg-button" class="switch-button" type="button" onclick="changeDisplayToReg()">Sign up</button>
            <button id="log-button" class="switch-button active" type="button" onclick="changeDisplayToLog()">Sign in</button>

        </div>
        <div id="login-page">
            <h2 class="blue-title">Sign in</h2>
            <p id="must-login">You need to log in to use translator</p>
            <div class="line"></div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                        <div class="form-group row">
                            <label for="email" id="login-email" class="text-input col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" id="login-password" class="text-input col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="text-input invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="text-input form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="text-input form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="submit">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
        </div>

        <div id="registration-page">
            <h2 class="blue-title">Sign up and have 14 days trial accass.</h2>
            <p id="must-register">You need to register to use translator</p>
            <div class="line"></div>
            <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="text-input col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="text-input col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="text-input col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="text-input input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="text-input col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
    @else
    <div id="action-div">
        <div id="login-page">
            <div id="userdiv-container">
                <div id='userdiv'>
                <br>
                <p class='usertext'>Hello, {{Auth::User()->name}}</p>
                <p class='usertext'>We wish You happy translating.</p>
                    <div id='button-container'>
                        <button id='logoutbtn1' onclick='scrollToTranslate()'>Scroll to translate</button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <button id='logoutbtn2' type="submit">Logout</button>
                        </form>
                    </div>  
                </div>
            </div>
        </div>

        <div id="registration-page">
            <h2 class="blue-title">Sign up and have 14 days trial accass.</h2>
            <div class="line"></div>
            <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="text-input col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="text-input col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="text-input col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="text-input input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="text-input col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
    @endif
</div>

   

    <script type="text/javascript" src="{{ asset('js/signup.js') }}"></script>
    <div id="process-container">
        <div id="image-container-background">
            <img class="backgroundsvg2" src="{{ asset('ass/new_ass/SmartLab-Webshape02.svg') }}" >
        </div>
        <div id="process-background">
            <h2 id="titlediv" class="process-title">Process</h2>
            <div id="image-container-steps">
                    <img class="process-images" id="upload-image" src="{{ asset('ass/Steps/icon01.svg') }}">
                    <img class="process-images" id="dots1" src="{{ asset('ass/Steps/dots01.svg') }}">
                    <img class="process-images" id="download-image" src="{{ asset('ass/Steps/icon02.svg') }}">
                    <img class="process-images" id="dots2" src="{{ asset('ass/Steps/dots02.svg') }}">
                    <img class="process-images" id="translate-image" src="{{ asset('ass/Steps/icon03.svg') }}">
                    <img class="process-images" id="dots3" src="{{ asset('ass/Steps/dots03.svg') }}">
                    <img class="process-images" id="ready-image" src="{{ asset('ass/Steps/icon04.svg') }}">
                </div>
            <div id="steps-container">
                <div id="upload" class="process-class">
                    <h3 class="process-steps">Upload your file</h3>
                    <p class="process-text">Upload XLF and select languages for translation</p>
                </div>

                <div id="download" class="process-class">
                    <h3 class="process-steps">Download XLS</h3>
                    <p class="process-text">Download XLS file (excel)  which contains all the data from you original XLF and additional collumns for  selected languages</p>
                </div>

                <div id="translate" class="process-class">
                    <h3 class="process-steps">Translate collumns</h3>
                    <p class="process-text">Insert translations in given collumns and upload your files (Original XLIFF and new XLS file with translations) </p>
                </div>

                <div id="ready" class="process-class">
                    <h3 class="process-steps">Ready for download</h3>
                    <p class="process-text">The App will created XLIFF files for selected languages and then they are ready for insertion in your Articulate project</p>
                </div>
            </div>
            <div id="orange-image-container">
                    <img id="orange-image-svg" src="{{ asset('ass/new_ass/SmartLab-Webshape04.svg') }}">
            </div>
        </div>
    </div>

    @if(!Auth::user())
    
    <div id="demo-container-background">
            <img class="demo-image-svg" src="{{ asset('ass/new_ass/SmartLab-Webshape03.svg') }}" >
    </div>
    <div id="demo-container">
        <div id="left-half">
            <div id="step-one">
                <h4 class="step-header">Step 1:</h4>
                <p class="step-text">Upload your original XLIFF file exported from Articulate. Make sure the you exported correct XLIFF format according the video instructions above.</p>
                <div class='drop-field'>
                    <label for='xlfupload' id='xlf-upload-label-id' onclick="mustLogin()"><input type='file' name='xlfupload' id='xlfupload' class='xlf-upload-class' accept='.xlf' onclick="mustLogin()"/><br><img class="uploadsvg" src="{{ asset('ass/new_ass/upload-icon.svg') }}" ><p id='uploadtext-xlf' class='uploadtext-big'>Drag & Drop XLIFF files to upload</p><p id='orxlftext' class='uploadtext-small'>or</p><img id='browsexlfsvg' class="browsesvg" src="{{ asset('ass/new_ass/BrowseButton.svg') }}" ></label>
                </div>
            </div>
            <div id="step-two">
                <h4 class="step-header">Step 2:</h4>
                <p class="step-text">Choose languages on which you want to translate your project and click "Send". After that the Excel file will be downloaded and there you should copy-paste translated text. </p>
                <p class="step-text" id="select-language-text">Select languages:</p>
                <div id="multiselect-container">
                    <select id="multiselect" name="languages[]" size="11" multiple required>
                        <option class="msvalue" value="en">English</option>
                        <option class="msvalue" value="de">German</option>
                        <option class="msvalue" value="it">Italian</option>
                        <option class="msvalue" value="fr">French</option>
                        <option class="msvalue" value="es">Spanish</option>
                        <option class="msvalue" value="cs">Czech</option>
                        <option class="msvalue" value="zh">Chinese</option>
                        <option class="msvalue" value="pt">Portugal</option>
                        <option class="msvalue" value="pl">Poland</option>
                        <option class="msvalue" value="ru">Russian</option>
                        <option class="msvalue" value="nl">Netherlands</option>
                    </select>
                    <a id="a-button" href="#log-button">
                        <button id="send-btn" class="submit" onclick="mustLogin()">Send
                        <svg version="1.1" id="send-img-btn" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve">
                        <path d="M476,3.2L12.5,270.6c-18.1,10.4-15.8,35.6,2.2,43.2L121,358.4l287.3-253.2c5.5-4.9,13.3,2.6,8.6,8.3L176,407v80.5
                            c0,23.6,28.5,32.9,42.5,15.8L282,426l124.6,52.2c14.2,6,30.4-2.9,33-18.2l72-432C515,7.8,493.3-6.8,476,3.2z"/>
                        </svg>
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div id="right-half">
            <div id="step-three">
                <h4 class="step-header">Step 3:</h4>
                <p class="step-text">Upload your updated Excel file so our App can generate translated XLIFF files in all languages you selected. <br><br></p>
                <div class='drop-field'>
                <div class='drop-field'>
                    <label for='xlsupload' name='xlsupload' id='xls-upload-label-id' onclick="mustLogin()"><br><img class="uploadsvg" src="{{ asset('ass/new_ass/uploadxls-icon.svg') }}" >
                    <input type='file' name='xlsupload' id='xlsupload' class='xls-upload-class' accept='.xls, .xlsx' onclick='mustLogin()'/>
                    <p id='uploadtext-xls' class='uploadtext-big'>Drag & Drop XLS file to upload</p><p id='orxlstext' class='uploadtext-small'>or</p><img id='browsexlssvg' class="browsesvg" src="{{ asset('ass/new_ass/BrowseButton.svg') }}" ></label>
                </div>
                </div>
            </div>
            <div id="step-four">
                <h4 class="step-header">Step 4:</h4>
                <p class="step-text">Now, you can insert translated XLIFF files to your Articulate project and all texts should be translated to desired language. <br><br></p>
            </div>
            <div>
                <p class="info-message">If you face any issue with our xls2xlf converter, feel free to write us on <a href="mailto: hello@smartlab.ba" >hello@smartlab.ba</a> and we will answer to you as soon  as possible</p>
            </div>            
        </div>
    </div>

    @else
    <div id="demo-container">
    
        <div id="left-half">
        <form action="/interface/exporter" method="post" enctype="multipart/form-data">
            @csrf
            <div id="step-one">
                <h4 class="step-header">Step 1:</h4>
                <p class="step-text">Upload your original XLIFF file exported from Articulate. Make sure the you exported correct XLIFF format according the video instructions above.</p>
                <div class='drop-field'>
                    <label for='xlfupload' id='xlf-upload-label-id'><input type='file' name='xlfupload' id='xlfupload' class='xlf-upload-class' accept='.xlf' onchange='changeInputText()' required/><br><img class="uploadsvg" src="{{ asset('ass/new_ass/upload-icon.svg') }}" ><p id='uploadtext-xlf' class='uploadtext-big'>Drag & Drop XLIFF files to upload</p><p id='orxlftext' class='uploadtext-small'>or</p><img id='browsexlfsvg' class="browsesvg" src="{{ asset('ass/new_ass/BrowseButton.svg') }}" ></label>
                </div>
            </div>
            <div id="step-two">
                <h4 class="step-header">Step 2:</h4>
                <p class="step-text">Choose languages on which you want to translate your project and click "Send". After that the Excel file will be downloaded and there you should copy-paste translated text. </p>
                <div id="multiselect-container">
                    <select id="multiselect" name="languages[]" size="11" multiple required>
                        <option class="msvalue" value="en">English</option>
                        <option class="msvalue" value="de">German</option>
                        <option class="msvalue" value="it">Italian</option>
                        <option class="msvalue" value="fr">French</option>
                        <option class="msvalue" value="es">Spanish</option>
                        <option class="msvalue" value="cs">Czech</option>
                        <option class="msvalue" value="zh">Chinese</option>
                        <option class="msvalue" value="pt">Portugal</option>
                        <option class="msvalue" value="pl">Poland</option>
                        <option class="msvalue" value="ru">Russian</option>
                        <option class="msvalue" value="nl">Netherlands</option>
                    </select>
                    <a id="a-button" href="#log-button">
                    <button type="submit" id="send-btn" class="submit">Send
                        <svg version="1.1" id="send-img-btn" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve">
                        <path d="M476,3.2L12.5,270.6c-18.1,10.4-15.8,35.6,2.2,43.2L121,358.4l287.3-253.2c5.5-4.9,13.3,2.6,8.6,8.3L176,407v80.5
                            c0,23.6,28.5,32.9,42.5,15.8L282,426l124.6,52.2c14.2,6,30.4-2.9,33-18.2l72-432C515,7.8,493.3-6.8,476,3.2z"/>
                        </svg>
                </button>
                    </a>
                </div>
            </div>
        </form>
        </div>

        <div id="right-half">
                <form action="/convertor" method="post" enctype="multipart/form-data">
                @csrf
            <div id="step-three">
                <h4 class="step-header">Step 3:</h4>
                <p class="step-text">Upload your updated Excel file so our App can generate translated XLIFF files in all languages you selected. </p> <br>
                <div class='drop-field'>
                    <label for='xlsupload' name='xlsupload' id='xls-upload-label-id'><br><img class="uploadsvg" src="{{ asset('ass/new_ass/uploadxls-icon.svg') }}" >
                    <input type='file' name='xlsupload' id='xlsupload' class='xls-upload-class' accept='.xls, .xlsx' onchange='changeInputTextXLS()' required/>
                    <p id='uploadtext-xls' class='uploadtext-big'>Drag & Drop XLS file to upload</p><p id='orxlstext' class='uploadtext-small'>or</p><img id='browsexlssvg' class="browsesvg" src="{{ asset('ass/new_ass/BrowseButton.svg') }}" ></label>
                </div>
            </div>
            <div id="step-four">
                <h4 class="step-header">Step 4:</h4>
                <p class="step-text">Now, you can insert translated XLIFF files to your Articulate project and all texts should be translated to desired language. </p>
                <input id='downloadxlf' name="submit" type='submit' value='Download'/>
                
            </div>
            <div>
                <p class="info-message">If you face any issue with our xls2xlf converter, feel free to write us on <a href="mailto: hello@smartlab.ba" >hello@smartlab.ba</a> and we will answer to you as soon  as possible</p>
            </div>     
            </form>
        </div>
    </div>
    
    @endif
    
    <footer>
    <!--<img class="footer-background" src="images/footer-dark.svg" />-->
    <div class="contain">
        <div class="footer-top-row">
            <nav class="footer-top-column --left">
                <ul>
                    <li><a href="/#anchor">@lang('menu.first_item')</a></li>
                    <li><a href="/#about">@lang('menu.second_item')</a></li>
                    <li><a href="{{asset('/pages/partner')}}">@lang('menu.third_item')</a></li> <!-- TODO do we have this page, we need to set link-->
                    <li><a href="{{env('BLOG_DOMAIN')}}/{{App::getlocale()}}" target="_blank">@lang('menu.fourth_item')</a></li>
                    <li><a href="/#contact">@lang('menu.fifth_item')</a></li>
                </ul>
            </nav>
            <div class="footer-top-column phone --center">
                <div>
                    <img src="{{asset('/ass/footer/social-icons/phone-receiver.svg')}}" />
                    <div class="footer-phone-container">
                        <p>
                            <a href="tel: 00387 61 811 394">+387 61 811 394</a>
                        </p>
                        <p>
                            <a href="tel: 00387 33 956 222">+387 33 956 222</a>
                        </p>
                    </div>
                </div>
                <div>
                    <img src="{{asset('/ass/footer/social-icons/mail.svg')}}" />
                    <p>
                        <a href=" mailto:hello@smartlab.ba">hello@smartlab.ba</a>
                    </p>
                </div>
            </div>
            <div class="footer-top-column --center nowrap">
                <img src="{{asset('/ass/footer/social-icons/location.svg ')}}" />
                <address>
                    <a href="https://www.google.com/maps/place/SmartLab/@43.8542408,18.3870703,17z/data=!3m1!4b1!4m5!3m4!1s0x4758c8c48c458d13:0xd3b7b0136b05bfe5!8m2!3d43.854237!4d18.389259" target="_blank">
                        <p>Kolodvorska 5,</p>
                        <p><span class="wrap">Sarajevo,</span> <span>@lang('footer.state')</span></p>
                    </a>
                </address>
            </div>
            <div class="footer-top-column --right">
                <button class="footer-button">
                    <a href="https://www.google.com/maps/place/SmartLab/@43.8542408,18.3870703,17z/data=!3m1!4b1!4m5!3m4!1s0x4758c8c48c458d13:0xd3b7b0136b05bfe5!8m2!3d43.854237!4d18.389259" target="_blank">@lang('footer.findUs')</a>
                </button>
            </div>
        </div>
        <div class="footer-bot-row">
            <div class="footer-bot-column --left ">
                <a href="#"><img src="{{asset('/ass/footer/social-icons/smartlab-white.svg')}}" class="footer-bot-icons" /></a>

            </div>
            <div class="footer-bot-column --center">
                Copyright &copy; 2019 SmartLab
            </div>
            <div class="footer-bot-column --right">
                <div class="social-icons-container">
                    <a href="https://www.facebook.com/smartlabsarajevo/" target="_blank"><img src="{{asset('/ass/footer/social-icons/fb-icon.svg')}}" class="footer-bot-icons" /></a>
                    <a href="https://www.linkedin.com/company/smartlab-sarajevo" target="_blank"><img src="{{asset('/ass/footer/social-icons/linkedin-icon.svg')}}" class=" footer-bot-icons" /></a>
                    <a href="#" target="_blank">
                        <img src="{{asset('/ass/footer/social-icons/skype-icon.svg')}}" class="footer-bot-icons" />
                    </a>
                    <a href="#" target="_blank">
                        <img src="{{asset('/ass/footer/social-icons/youtube-icon.svg')}}" class="footer-bot-icons no-right-margin" />
                    </a>
                </div>
            </div>
        </div>
        </div>
        
    </footer>
    <script type="text/javascript" src="{{ asset('js/dragandrop.js') }}"></script>
    </body>

</html>

