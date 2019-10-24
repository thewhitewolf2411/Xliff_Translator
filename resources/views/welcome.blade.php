
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/signup.css') }}" />
        <title>Index</title>
    </head>

    <style>
    
    #registration-page {

        display:none;
    }
    
    </style>

    <body>

    <div id="head">
    
        <img id="backgroundsvg" src="{{ asset('ass/top-bg.svg') }}" >
        <div id="text">
        
            <p id="contact-top">Call: </p> <p id="contact-top">+387 61 811 394</p> <p id="contact-top">+387 33 956 222 </p> <p id="contact-top"> Language: </p>
            <form id="languageForm" action="/language" method="POST">
            <!-- Form for sending new language after user clicks on one of the select options - page is refreshed with new language translations -->
            @csrf
            @method('PUT')

                <input type="radio" name="language" id="en" value="en" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='en' ) checked @endif><label for="en" @if(App::getlocale()=='en' ) class="language-selected" @endif>@lang('menu.english_language')</label>
                <input type="radio" name="language" id="de" value="de" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='de' ) checked @endif><label for="de" @if(App::getlocale()=='de' ) class="language-selected" @endif>@lang('menu.german_language')</label>
                <input type="radio" name="language" id="bs" value="bs" onclick="changeSiteLanguage(this.value)" @if(App::getlocale()=='bs' ) checked @endif><label for="bs" @if(App::getlocale()=='bs' ) class="language-selected" @endif>@lang('menu.bosnian_language')</label>

            </form>
        </div>
        
    
    </div>

    <div id="meni-div">

        <p id="xls-title"><strong>xls2xlf</strong></p>
        <img id="logosvg" src="{{ asset('ass/smartlab-logo.svg') }}" >

    </div>

    <div id="row-div">

        <h2 id="titlediv"><strong>Articulate Storyline <br> automatic text translation.</strong></h2>
        <p id="subtext-regular"><strong id="subtext-bold">Find out More:</strong> <br><br> Xliff Articulate Translation Tool Tutorial.</p> 
        <img id="playvideobtn" src= "{{ asset('ass/play-button.svg') }}" onclick="playvideo()">

    </div>

    <div id="text-sigup">
        <div id="text-content">
            <h3>xls2xlf converter</h3>
            <p id="text-content-p">If you are working on an Articulate Storyline project which should be translated in different languages, then we have a solution which can do that work for you. We developed an App which can: <br><br> </p>
            <ul id="list-main">
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Import your original XLIFF file exported from your Articulate project </strong><br><br> </li>
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Generate Excel spreadsheet prepared for inserting translated text </strong><br><br> </li>
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Compare original XLIFF will uploaded translations </strong><br><br> </li>
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Engaging tools for webinars </strong><br><br> </li>
                <li class="list-c">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Provide you translated XLIFF in all languages you need so you can import them in your Articulate file and all texts should be translated in new languages without any format change or design. </strong><br><br> </li>
            </ul> 
        </div>

    <div id="action-div">
        <div id="button-cont">
        
            <button id="reg-button" class="switch-button" type="button" onclick="changeDisplayToReg()">Sign up</button>
            <button id="log-button" class="switch-button active" type="button" onclick="changeDisplayToLog()">Sign in</button>

        </div>
        <div id="login-page">
            <h2 class="blue-title">Sign in</h2>
            <div class="line"></div>
            <form method="POST" action="{{ route('login') }}">
                        @csrf

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

</div>

   

    <script type="text/javascript" src="{{ asset('js/signup.js') }}"></script>

    <div id="process-container">
    
        <div id="process-background">
            <h2 id="titlediv" class="process-title">Process</h2>
            <div id="img-steps">
                <img id="steps-img" src="{{ asset('ass/process-icons.svg') }}" >
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
        </div>
        <img id="white-background" src="{{ asset('ass/light-blue-bg.svg') }}" >
    </div>

    <div id="demo-container">
    
        <div id="left-half">
            <div id="step-one">
                <h4 class="step-header">Step 1:</h4>
                <p class="step-text">Upload your original XLIFF file exported from Articulate. Make sure the you exported correct XLIFF format according the video instructions above.</p>
                <button class="upload-btn" id="upload-btn">Upload XLIFF</button>
            </div>
            <div id="step-two">
                <h4 class="step-header">Step 2:</h4>
                <p class="step-text">Choose languages on which you want to translate your project and click "Send". After that the Excel file will be downloaded and there you should copy-paste translated text. </p>
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
                <button id="send-btn" class="submit" onclick="sendLanguages()">Send</button>
            </div>
        </div>

        <div id="right-half">
            <div id="step-three">
                <h4 class="step-header">Step 3:</h4>
                <p class="step-text">Upload your updated Excel file so our App can generate translated XLIFF files in all languages you selected. </p>
            </div>
            <div id="step-four">
                <h4 class="step-header">Step 4:</h4>
                <p class="step-text">Now, you can insert translated XLIFF files to your Articulate project and all texts should be translated to desired language. </p>
            
            </div>
        </div>

    </div>

    <div id="footer">
    
    <img id="footersvg" src="{{ asset('ass/footer.svg') }}" >
        <div id="row-one">
            <div id="col-one">
                <a class="footer-text" href="https://smartlab.ba/#anchor">What we do</a>
                <a class="footer-text" href="https://smartlab.ba/#about">Who we are</a>
                <a class="footer-text" href="https://smartlab.ba/pages/partner">Join us</a>
                <a class="footer-text" href="https://blog.smartlab.ba/en">Blog</a>
                <a class="footer-text" href="https://smartlab.ba/#contact">Contact</a>
            </div>
            <div id="col-two">
                <a class="footer-text" href="tel:00387 61 811 394">+387 61 811 394  </a>
                <a class="footer-text" href="tel:00387 33 956 222">+387 33 956 222 </a>
                <br><br><br>
                <a class="footer-text" href="mailto:hello@smartlab.ba">hello@smartlab.ba </a>
            </div>
            <div id="col-three">
                <a class="footer-text" href="https://www.google.com/maps/place/SmartLab/@43.8542408,18.3870703,17z/data=!3m1!4b1!4m5!3m4!1s0x4758c8c48c458d13:0xd3b7b0136b05bfe5!8m2!3d43.854237!4d18.389259" target="_blank">Kolodvorska 5, <br>Sarajevo Bosna i Hercegovina </a>
            </div>
            <div id="col-four">
                <button class="find-us">Find us</button>
            </div>
        </div>
        <div id="row-two">
            <div id="col-one-two">
                <img id="smartlab-white" src="{{ asset('ass/smartlab-white.svg') }}" >
            </div>
            <div id="col-two-two">
                <p class="footer-text" id="copyright">Copyright © 2019 SmartLab</p>
            </div>
            <div id="col-three-two">
                <a href="https://www.facebook.com/smartlabsarajevo/"><img class="icons" src="{{ asset('ass/fb-icon.svg') }}"> </a>
                <a href="https://www.linkedin.com/company/smartlab-sarajevo/"><img class="icons" src="{{ asset('ass/linkedin-icon.svg') }}"> </a>
                <a href="https://smartlab.ba/#"><img class="icons" src="{{ asset('ass/skype-icon.svg') }}"> </a>
                <a href="https://smartlab.ba/#"><img class="icons" src="{{ asset('ass/youtube-icon.svg') }}"> </a>
            </div>
        </div>

    </div>

    </body>

</html>

