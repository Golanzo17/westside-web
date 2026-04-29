@extends('layouts.app')

@section('content')



    <!-- SECCIÓN QUIÉNES SOMOS - STORYTELLING -->
    <section class="storytelling-section">
        <div class="story-container">
            
            <!-- Columna Izquierda: Textos que scrollean -->
            <div class="story-text-column">
                <div class="story-step" data-step="1">
                    <p>West Side nace en 2024 entre amigos, con una idea clara: crear algo propio dentro de la cultura urbana. Empezamos como un proyecto online enfocado en accesorios y ropa, buscando ofrecer productos que realmente representen estilo, identidad y actitud.</p>
                </div>
                
                <div class="story-step" data-step="2">
                    <p>Con el tiempo, esa visión creció. No solo queríamos que te vistas bien, queríamos que te sientas bien. Así fue como en 2025 dimos un paso más y abrimos nuestro primer espacio físico, incorporando el servicio de barbería como parte esencial de la experiencia West Side.</p>
                </div>
                
                <div class="story-step" data-step="3">
                    <p>Hoy somos más que una marca. Somos un punto de encuentro entre estilo, cuidado personal y cultura urbana. Creemos en el detalle, en la evolución constante y en ayudarte a potenciar tu imagen en todos los aspectos.</p>
                </div>
                
                <div class="story-step" data-step="4">
                    <p>West Side no es solo lo que usás, es cómo te mostrás al mundo.</p>
                </div>
            </div>

            <!-- Columna Derecha: Imágenes fijas (Sticky) que cambian -->
            <div class="story-visual-column">
                <div class="visual-wrapper">
                    <!-- Imagen 1 -->
                    <div class="story-image active" id="story-img-1">
                        <img src="/images/Quienes-somos/Grupal.jpeg" alt="Historia West Side"> 
                    </div>
                    <!-- Imagen 2 -->
                    <div class="story-image" id="story-img-2">
                        <img src="/images/Quienes-somos/Progreso.jpeg" alt="Historia West Side">
                    </div>
                    <!-- Imagen 3 -->
                    <div class="story-image" id="story-img-3">
                        <img src="/images/Quienes-somos/Barberia.jpeg" alt="Historia West Side">
                    </div>
                    <!-- Imagen 4 -->
                    <div class="story-image" id="story-img-4">
                        <img src="/images/westside-logo2.jpg" alt="Historia West Side">
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('partes.ig-cards')

    


    <!-- SCRIPT PARA EL EFECTO DE SCROLL ("Scrollytelling") -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const steps = document.querySelectorAll('.story-step');
            const images = document.querySelectorAll('.story-image');

            // Usamos IntersectionObserver para detectar cuándo un párrafo llega al medio de la pantalla
            const observerOptions = {
                root: null,
                rootMargin: '-40% 0px -40% 0px', // Se activa cuando el elemento cruza el 40% central de la pantalla
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Obtener el número del párrafo actual
                        const stepIndex = entry.target.getAttribute('data-step');

                        // 1. Iluminar el texto actual y apagar los demás
                        steps.forEach(s => s.classList.remove('is-active'));
                        entry.target.classList.add('is-active');

                        // 2. Mostrar la imagen correspondiente y ocultar las demás con efecto fade
                        images.forEach(img => img.classList.remove('active'));
                        const currentImg = document.getElementById('story-img-' + stepIndex);
                        if(currentImg) {
                            currentImg.classList.add('active');
                        }
                    }
                });
            }, observerOptions);

            // Empezar a observar todos los párrafos
            steps.forEach(step => observer.observe(step));
            
            // Activar el primer elemento manualmente al cargar
            if(steps.length > 0) {
                steps[0].classList.add('is-active');
            }
        });
    </script>
@endsection
