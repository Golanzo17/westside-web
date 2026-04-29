{{--
    ============================================================
    PARTIAL: turnos-servicios.blade.php
    Uso: @include('partes.turnos-servicios')
    Descripción: Tarjetas de servicios de la barbería (Corte, Barba, Color)
                 y divider decorativo. CSS incluido.
    ============================================================
--}}

<!-- SERVICIOS -->
<section class="servicios-section">
    <div class="servicios-container">
        <h2 class="section-label">Nuestros Servicios</h2>
        <div class="servicios-grid">
            <div class="servicio-card" data-servicio="Corte de cabello">
                <div class="servicio-icon">💈</div>
                <h3 class="servicio-nombre">Corte de Cabello</h3>
                <p class="servicio-desc">Fade, undercut, clásico o lo que tengas en mente. Lo trabajamos con detalle y precisión.</p>
                <div class="servicio-tag">Desde $11.000</div>
            </div>
            <div class="servicio-card" data-servicio="Arreglo de barba">
                <div class="servicio-icon">🪒</div>
                <h3 class="servicio-nombre">Arreglo de Barba</h3>
                <p class="servicio-desc">Perfilado, diseño o afeitado completo. Dejá que los detalles hablen por vos.</p>
                <div class="servicio-tag">Desde $3.500</div>
            </div>
            <div class="servicio-card" data-servicio="Coloración">
                <div class="servicio-icon">🎨</div>
                <h3 class="servicio-nombre">Coloración</h3>
                <p class="servicio-desc">Mechas, decoloración, tintes y más. Dale un giro a tu imagen con color.</p>
                <div class="servicio-tag">Consultar precio</div>
            </div>
        </div>
    </div>
</section>

<!-- DIVIDER -->
<div class="seccion-divider">
    <div class="divider-line"></div>
    <span class="divider-icon">✦</span>
    <div class="divider-line"></div>
</div>


