    <!-- FORMULARIO DE CONSULTAS -->
    <section id="consultas" class="contact-section" @if(isset($paddingTop)) style="padding-top: {{ $paddingTop }};" @endif>
        <div class="form-container gs-reveal">
            <h2>Dejanos tu Consulta</h2>
            
            <!-- Contenedor del Formulario -->
            <div id="contact-form-wrapper">
                <form id="contact-form" action="#" method="POST" class="contact-form">
                    <div class="input-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" id="name" name="name" placeholder="Tu nombre" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com" required>
                    </div>
                    <div class="input-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" name="message" rows="4" placeholder="Escribe tu consulta aquí..." required></textarea>
                    </div>
                    <button type="submit" class="btn-primary btn-full">Enviar Consulta</button>
                </form>
            </div>

            <!-- Mensaje de Éxito (Oculto por defecto) -->
            <div id="success-message" style="display: none; text-align: center; padding: 40px 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#25D366" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 20px;">
                    <path d="M22 11.08V12a10 10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <h3 style="font-family: var(--font-impact); font-size: 2rem; color: var(--text-main); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">¡Mensaje Enviado!</h3>
                <p style="color: var(--text-muted); font-size: 1.1rem;">Gracias por escribirnos. Te responderemos a la brevedad.</p>
                <button type="button" class="btn-primary" onclick="resetForm()" style="margin-top: 25px; padding: 8px 20px;">Enviar otra consulta</button>
            </div>
        </div>
    </section>

    <!-- SCRIPT PARA SIMULAR EL ENVÍO -->
    <script>
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Evita que la página recargue o tire error

            // Cambiar el texto del botón temporalmente para simular carga
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.innerText = 'Enviando...';
            btn.style.opacity = '0.7';
            btn.disabled = true;

            // Simular un retraso de red de 1 segundo
            setTimeout(() => {
                document.getElementById('contact-form-wrapper').style.display = 'none';
                document.getElementById('success-message').style.display = 'block';
                
                // Resetear el botón por si el usuario vuelve
                btn.innerText = originalText;
                btn.style.opacity = '1';
                btn.disabled = false;
                this.reset();
            }, 1000);
        });

        function resetForm() {
            document.getElementById('success-message').style.display = 'none';
            document.getElementById('contact-form-wrapper').style.display = 'block';
        }
    </script>
