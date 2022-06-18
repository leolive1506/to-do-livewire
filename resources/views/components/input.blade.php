@props(['disabled' => false, 'name' => '', 'type' => 'text', 'placeholder' => '', 'value' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full']) !!} name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
