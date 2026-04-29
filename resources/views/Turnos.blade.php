@extends('layouts.app')

@section('content')



    @include('partes.hero-general', [
        'badge' => 'Barbería West Side',
        'title' => 'Reservá tu Turno',
        'subtitle' => 'Elegí tu servicio, mandanos un mensaje y te confirmamos en minutos.<br>También podés pasarte directo al local.'
    ])

    @include('partes.turnos-servicios')

    {{-- SECCIÓN: Productos de Barbería --}}
    <section class="barber-shop-products">
        <div class="barber-shop-products-inner">
            <div class="barber-section-header">
                <span class="section-badge">Llevate el look a casa</span>
                <h2 class="barber-section-title">Productos de Barbería</h2>
                <p class="barber-section-sub">Los mismos productos que usamos en el local, disponibles para vos.</p>
            </div>
            <div class="barber-products-grid" id="barber-products-grid">
                @include('partes.productos_estaticos_barberia')
            </div>
        </div>
    </section>

    @include('partes.turnos-opciones')

    @include('partes.turnos-formulario')



    <script>
    
        const WSP_NUMBER = window.WSP;

        // Animación de entrada — catálogo de barbería
        const barberObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('card-visible');
                    barberObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0, rootMargin: '0px' });

        document.querySelectorAll('#barber-products-grid .product-card').forEach(card => barberObserver.observe(card));

        // WhatsApp dinámico para productos de barbería
        document.querySelectorAll('#barber-products-grid .product-overlay-btn').forEach(btn => {
            const name = btn.closest('.product-card').querySelector('h4').innerText;
            btn.href = `https://wa.me/${WSP_NUMBER}?text=${encodeURIComponent('Hola! Me interesa el producto de barbería: ' + name + '. ¿Tienen disponibilidad?')}`;
        });

        // Al hacer clic en una tarjeta de servicio, pre-selecciona en el formulario
        document.querySelectorAll('.servicio-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.servicio-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                const servicio = card.getAttribute('data-servicio');
                const select = document.getElementById('turno-servicio');
                for (let opt of select.options) {
                    if (opt.value === servicio) { opt.selected = true; break; }
                }
                document.querySelector('.wsp-form-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Botón directo de la sección opciones
        document.getElementById('wsp-turno-btn').href =
            `https://wa.me/${WSP_NUMBER}?text=${encodeURIComponent('Hola! Quiero sacar un turno en West Side Barber. ¿Tienen disponibilidad?')}`;
    </script>

@endsection
