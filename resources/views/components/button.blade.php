@if(!empty($route))
    <a href="{{ $route }}">
        <button class="btn {{ $color ?? 'btn-primary' }}" type="{{ $type ?? 'button' }}">
            {{ $slot }}
        </button>
    </a>
@else
    <button class="btn {{ $color ?? 'btn-primary' }}" type="{{ $type ?? 'button' }}">
        {{ $slot }}
    </button>

@endif

