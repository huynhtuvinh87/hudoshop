  <div class="menu-mobi main" id="menu-mobile">
      <a class="close-menu" href="#"><i class="remove"><img src="/shop/images/close.png" alt="icon"></i></a>
      <div class="menu-mobi-wrapper">
          <div class="top-menu">
              <div class="user">
                  <ul class="user-login">
                      <li class="signup"><a href="https://id.vinagex.com/register">Đăng ký</a></li>
                      <li class="login"><a href="https://id.vinagex.com/login">Đăng nhập</a></li>
                  </ul>
              </div>
          </div>
          <div class="list-menu">
              <nav class="side-nav">
                  <ul class="nav-menu nav-menu1">
                      @if(Constant::menu()->category)
                      @foreach(Constant::menu()->category as $k=>$value)
                      <li><a href="{{$value->link}}"> {{$value->title}}</a></li>
                      @endforeach
                      @endif
                  </ul>
              </nav>

          </div>
          <div class="hotline">
              <span class="hotline_text">HOTLINE</span>
              <span class="hotline_number">{{Constant::setting()->phone}}</span>
          </div>
      </div>
  </div>
