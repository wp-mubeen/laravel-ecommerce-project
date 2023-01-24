

$( document ).ready(function() {
    $(".addtowishlist").click(function (e) {
        e.preventDefault();

        var product = $(this).attr('productid');

        $.ajax({
            method: "post",
            url: "{{ url('/add-to-wishlist') }}",
            data: {_token: '{{ csrf_token() }}', pid: product },

            success: function (response) {
                console.log(response);
                // window.location.reload();
            }
        });
    });
});
