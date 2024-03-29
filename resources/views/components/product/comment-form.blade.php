@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ url('product/'.$slug ) }}" method="post" id="commentform" class="comment-form" novalidate="">
    @csrf
    <p class="comment-notes">
        <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
    </p>
    <div class="comment-form-rating">
        <span>Your rating</span>
        <p class="stars">
            <input type="hidden" value="{{ $productid }}" name="product_id">
            <label for="rated-1"></label>
            <input type="radio" id="rated-1" name="rating" value="1">
            <label for="rated-2"></label>
            <input type="radio" id="rated-2" name="rating" value="2">
            <label for="rated-3"></label>
            <input type="radio" id="rated-3" name="rating" value="3">
            <label for="rated-4"></label>
            <input type="radio" id="rated-4" name="rating" value="4">
            <label for="rated-5"></label>
            <input type="radio" id="rated-5" name="rating" value="5" checked="checked">
        </p>
    </div>
    <p class="comment-form-author">
        <label for="author">Name <span class="required">*</span></label>
        <input id="author" name="name" class="@error('name') is-invalid  @enderror" type="text" value="">
    </p>
    <p class="comment-form-email">
        <label for="email">Email <span class="required">*</span></label>
        <input id="email" name="email" class="@error('email') is-invalid  @enderror" type="email" value="" >
    </p>
    <p class="comment-form-comment">
        <label for="comment">Your review <span class="required">*</span>
        </label>
        <textarea id="comment" name="comment" class="@error('comment') is-invalid  @enderror" cols="45" rows="8"></textarea>
    </p>
    <p class="form-submit">
        <input name="submit" type="submit" id="submit" class="submit" value="Submit">
    </p>
</form>
