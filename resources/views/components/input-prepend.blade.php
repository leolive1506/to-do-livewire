@props(['disabled' => false, 'name' => '', 'type' => 'text', 'placeholder' => '', 'value' => '', 'prepend' => 'R$'])

<div class="relative flex w-full flex-wrap items-stretch mb-3">
    <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
      <i class="fas fa-lock">{{ $prepend }}</i>
    </span>
    <input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white  rounded text-sm border-gray-300 shadow outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full pl-10']) }} name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ $value }}" />
  </div>
