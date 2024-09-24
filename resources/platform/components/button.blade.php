@props([
    'label' => null,
    'color' => 'primary',
    'size' => null,
    'type' => 'button',
    'route' => null,
    'url' => null,
    'href' => null,
    'dismiss' => null,
    'toggle' => null,
    'click' => null,
    'confirm' => false,
    'loading' => false,
])

@php
    if ($route) $href = route($route);
    else if ($url) $href = url($url);

    $attributes = $attributes->class([
        'btn btn-' . $color,
        'btn-' . $size => $size,
        $loading ? 'disabled' : null,
    ])->merge([
        'type' => !$href ? $type : null,
        'href' => $href,
        'data-bs-dismiss' => $dismiss,
        'data-bs-toggle' => $toggle,
        'wire:click' => $click,
        'onclick' => $confirm ? 'confirm(\'' . __('Are you sure?') . '\') || event.stopImmediatePropagation()' : null,
    ]);
@endphp

<{{ $href ? 'a' : 'button' }} {{ $attributes }}>
@if($loading)<span class="spinner-border spinner-border-sm me-2" role="status"></span>@endif
{{ $label ?? $slot }}
</{{ $href ? 'a' : 'button' }}>
