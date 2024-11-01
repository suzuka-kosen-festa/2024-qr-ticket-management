@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm my-4 bg-red-500 p-4 text-white font-bold space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
