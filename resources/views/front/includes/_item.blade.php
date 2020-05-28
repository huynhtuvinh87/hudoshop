 <div class="item">
     <a class="thumb" href="/{{ $data->slug.'-'.$data->id }}">
         <img class="lazyload" data-src="/image.php?src={{Constant::getFileImage($data->image)}}&size=215x215" src="{{ asset('images/image_default.png') }}" alt="{{ $data->title }}"> </a>
     <div class="desc">
         <h4 class="title">
             <a href="/{{ $data->slug.'-'.$data->id }}" title=" {{ $data->title }}">
                 {{ $data->title }}</a></h4>

         <div class="bottom">
             <div class="pull-left minimum price">{{number_format($data->price, 0, '', ',')}} VNĐ</div>
             <!-- <div class="rating pull-right">
                 <div class="star">
                     <div class="empty-stars"></div>
                     <div class="full-stars" style="width:90%"> </div>
                 </div>
                 (2)
             </div> -->
         </div>
     </div>
 </div>
