    
</style>
    <div class="contain">
        <div class="footer-top-row">
            <div class="footer-top-column --left">
                <ul>
                    <li><a href="/#anchor">@lang('menu.first_item')</a></li>
                    <li><a href="/#about">@lang('menu.second_item')</a></li>
                    <li><a href="{{asset('/pages/partner')}}">@lang('menu.third_item')</a></li> <!-- TODO do we have this page, we need to set link-->
                    <li><a href="{{env('BLOG_DOMAIN')}}/{{App::getlocale()}}" target="_blank">@lang('menu.fourth_item')</a></li>
                    <li><a href="/#contact">@lang('menu.fifth_item')</a></li>
                </ul>
</div>
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
        