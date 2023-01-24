@component('mail::message')

Hello {{ $name }}

We’re happy to let you know that we’ve received your order.

Once your package ships, we will send you an email with a tracking number and link so you can see the movement of your package.

If you have any questions, contact us here or call us on [contact number]!

We are here to help!

@component('mail::button', ['url' => '#'])
Contact Us
@endcomponent

@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      | $10      |
    | Col 3 is      | Right-Aligned | $20      |
@endcomponent

@component('mail::panel')
    This is the panel content.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
