<x-mail::message>
    # Product Created

    Your product has been created!

    <x-mail::table>
        | Key       | Value         |
        | --------- |:-------------:|
        | Name      | {{ $product->name }}      |
        | Price     | {{ $product->price }}      |
        | Status    | {{ $product->status->value }} |
        | Type      | {{ $product->type->value }} |
    </x-mail::table>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
