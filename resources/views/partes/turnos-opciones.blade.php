{{--
    ============================================================
    PARTIAL: turnos-opciones.blade.php
    Uso: @include('partes.turnos-opciones')
    Descripción: Sección "¿Cómo querés sacar tu turno?" con las dos
                 opciones: WhatsApp y Presencial. CSS incluido.
    ============================================================
--}}

<!-- DOS OPCIONES -->
<section class="opciones-section">
    <div class="opciones-container">
        <h2 class="section-label">¿Cómo querés sacar tu turno?</h2>
        <div class="opciones-grid">

            <!-- Opción 1: WhatsApp -->
            <div class="opcion-card opcion-online">
                <div class="opcion-num">01</div>
                <div class="opcion-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <h3>Por WhatsApp</h3>
                <p>Mandanos un mensaje con el servicio que querés y el día/horario que te queda mejor. Te confirmamos en el momento.</p>
                <ul class="opcion-beneficios">
                    <li>✔ Respuesta inmediata</li>
                    <li>✔ Sin esperas</li>
                    <li>✔ Confirmación al instante</li>
                </ul>
                <a id="wsp-turno-btn" href="#" target="_blank" class="btn-wsp-turno">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.555 4.124 1.528 5.855L0 24l6.335-1.51A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 0 1-5.007-1.37l-.36-.214-3.727.977.994-3.634-.234-.373A9.77 9.77 0 0 1 2.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                    Pedir Turno por WhatsApp
                </a>
            </div>

            <!-- Opción 2: Presencial -->
            <div class="opcion-card opcion-presencial">
                <div class="opcion-num">02</div>
                <div class="opcion-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h3>Presencial</h3>
                <p>Si preferís, pasate directo por el local. Atendemos por orden de llegada y siempre te vamos a recibir con buena onda.</p>
                <ul class="opcion-beneficios">
                    <li>📍 Hipólito Yrigoyen 2418, Corrientes</li>
                    <li>🕐 Lunes a Sábados</li>
                    <li>⏰ 9:00 a 22:00 hs</li>
                </ul>
                <a href="https://maps.google.com/?q=Hipólito+Yrigoyen+2418+Corrientes" target="_blank" class="btn-mapa">
                    Ver en Google Maps →
                </a>
            </div>

        </div>
    </div>
</section>


