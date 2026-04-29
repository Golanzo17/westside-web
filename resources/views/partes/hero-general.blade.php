{{-- Componente de Cabecera General (Hero) --}}
<section class="general-hero">
    <div class="general-hero-content">
        @if(isset($badge))
            <span class="section-badge">{{ $badge }}</span>
        @endif
        
        <h1 class="general-hero-title">{{ $title }}</h1>
        
        @if(isset($subtitle))
            <p class="general-hero-sub">{!! $subtitle !!}</p>
        @endif
    </div>
</section>
