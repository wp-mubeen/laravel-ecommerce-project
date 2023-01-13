@if (count($subcategory) >= 1)
    <span class="toggle-control">+</span>
    <ul class="sub-cate  mmmoore">
        @foreach($subcategory as $catg)
            <li class="category-item"><a href="{{ $catg['slug'] }}" class="cate-link">{{ $catg['name'] }}</a></li>
        @endforeach
    </ul>
@endif
