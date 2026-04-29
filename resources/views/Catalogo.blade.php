@extends('layouts.app')

@section('content')
    @include('partes.hero-catalogo')

    <!-- GRILLA -->
    <section class="cat-grid-section">
        <div class="cat-grid-container">
            <div class="products-grid" id="catalog-products">
                @include('partes.productos_estaticos')
            </div>
            <div id="noProductsMessage" class="cat-empty">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <h4>No encontramos productos</h4>
                <p>Probá con otro término o quitá el filtro activo.</p>
            </div>
        </div>
    </section>

    

    <script>
        const WSP_CAT = window.WSP;

        // === Animación de entrada escalonada con IntersectionObserver ===
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('card-visible');
                    cardObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0, rootMargin: '0px' });

        const cards = document.querySelectorAll('#catalog-products .product-card');
        cards.forEach(card => cardObserver.observe(card));

        // Contador inicial real
        const totalCards = cards.length;
        document.getElementById('productCount').textContent = totalCards + ' producto' + (totalCards !== 1 ? 's' : '');

        // Links de WhatsApp dinámicos en cada overlay
        document.querySelectorAll('.product-overlay-btn').forEach(btn => {
            const name = btn.closest('.product-card').querySelector('h4').innerText;
            btn.href = `https://wa.me/${WSP_CAT}?text=${encodeURIComponent('Hola! Me interesa el producto: ' + name + '. ¿Tienen disponibilidad?')}`;
        });

        // Filtros
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
                filterProducts();
            });
        });

        document.getElementById('productSearch').addEventListener('input', filterProducts);

        function filterProducts() {
            const search = document.getElementById('productSearch').value.toLowerCase().trim();
            const active = document.querySelector('.filter-chip.active').getAttribute('data-filter');
            const cards  = document.querySelectorAll('#catalog-products .product-card');
            let visible  = 0;

            cards.forEach(card => {
                const title    = card.querySelector('h4')?.innerText.toLowerCase() || '';
                const category = card.getAttribute('data-category') || '';
                const matchS   = !search || title.includes(search);
                const matchF   = active === 'all' || category === active;

                if (matchS && matchF) {
                    card.style.display = '';
                    card.style.animationDelay = (visible * 0.05) + 's';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('productCount').textContent = visible + ' producto' + (visible !== 1 ? 's' : '');
            document.getElementById('noProductsMessage').style.display = visible === 0 ? 'block' : 'none';
        }
    </script>

@endsection
