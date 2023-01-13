
@if (count($product) >= 1)
<ol class="commentlist">
    @foreach($product as $review )
        @php
           if( $review->rating == 1 ){
              $class =  'width-20-percent';
          }elseif(  $review->rating == 2 ){
              $class =  'width-40-percent';
           }elseif( $review->rating == 3 ){
               $class =  'width-60-percent';
           }elseif( $review->rating == 4 ){
                $class =  'width-80-percent';
           }elseif( $review->rating == 5 ){
                $class =  'width-100-percent';
           }else{
               $class = 'no-comment';
           }
        @endphp
        <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
            <div id="comment-20" class="comment_container">
                @if(empty($review->picture))
                    <img alt="" src="{{ asset('users/images/no-image.png')  }}" height="80" width="80">
                @else
                    <img alt="" src="{{ url( $review->picture )   }}" height="80" width="80">
                @endif

                <div class="comment-text">
                    <div class="star-rating">
                        <span class="{{ $class }}">Rated <strong class="rating">{{ $review->rating }}</strong> out of 5</span>
                    </div>
                    <p class="meta">
                        <strong class="woocommerce-review__author">{{ $review->name }}</strong>
                        <span class="woocommerce-review__dash">–</span>
                        <time class="woocommerce-review__published-date" datetime="" >{{ $review->created_at }} </time>
                    </p>
                    <div class="description">
                        <p>{{ $review->comment }}</p>
                    </div>
                </div>
            </div>
        </li>

    @endforeach

</ol>
@endif
