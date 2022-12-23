@if($category)
<span class="toggle-control">+444</span>
<ul class="sub-cate  mmmoore">
    @foreach($category as $catg)
    <li class="category-item"><a href="{{ $catg->slug }}" class="cate-link">{{ $catg->name }}</a></li>
    @endforeach
</ul>
@endif
