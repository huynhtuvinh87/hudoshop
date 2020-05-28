    <footer>
        <div class="footer-top">
            <div class="container container-mobile">
                <div class="row">
                    <div class="col-sm-9 footer-menu">
                        <div class="row">
                            <div class="col-sm-4 col-b-left">
                                <section class="widget about-us-wg">
                                    <h4 class="widget-title">Liên hệ</h4>
                                    <div class="textwidget">
                                        <ul class="menu">
                                            <li>Điện thoại: 0905951699</li>
                                            <li>Email: <a href="javascript:void(0)" class="text-success">huynhtuvinh87@gmail.com</a></li>
                                            <li>Địa chỉ: Số 15, Mỹ An 19, Ngũ Hanhf Sơn, Đà Nẵng</li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            <div class="col-sm-4 col-b-left">
                                <section class="widget cooperate-wg">
                                    <h4 class="widget-title">Hỗ trợ khách hàng</h4>
                                    <div class="textwidget">
                                        <ul class="menu">
                                            @if(!empty(Constant::widget()->help))
                                            @foreach(Constant::widget()->help as $k=>$value)
                                            <li><a href="{{url('p/'.$value->slug.'-'.$value->id)}}">{{$value->title}}</a></li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            <div class="col-sm-4 col-b-left">
                                <section class="widget help-wg">
                                    <h4 class="widget-title">Về chúng tôi</h4>
                                    <div class="textwidget">
                                        <ul class="menu">
                                            <li><a target="_blank" href="#">Về Vitamins Australia</a></li>
                                            <li><a target="_blank" href="#">Về đất nước và con ngời Úc</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 location">
                        <section class="widget location-wg">
                            <h4 class="widget-title">Kết nối với chung tôi</h4>
                            <div class="textwidget">
                                <div class="social_share">
                                    <span id="share-buttons">
                                        <a rel="nofollow" href="http://www.facebook.com" target="_blank">
                                            <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook">
                                        </a>

                                        <a rel="nofollow" href="http://www.linkedin.com/" target="_blank">
                                            <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn">
                                        </a>

                                        <a rel="nofollow" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                            <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest">
                                        </a>

                                        <a rel="nofollow" href="https://twitter.com/" target="_blank">
                                            <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter">
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </footer>
