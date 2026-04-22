<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body>

    @include('partes.nav')

    <!-- 1. Principal -->
    <section id="principal" class="hero-section">
        <div class="hero-overlay"></div>
        <img src="/images/baners/banner2.png" alt="Westside Hero" class="hero-bg">
        <div class="hero-content gs-reveal">
            <h1 class="title-impact">WESTSIDE</h1>
            <p>Streetwear & Premium Barber</p>
            <a href="#catalogo" class="btn-primary btn-large">Ver Colección</a>
        </div>
    </section>

    <!-- 2. Quienes Somos -->
    <section id="quienes-somos" class="about-section">
        <div class="container dual-grid">
            <div class="text-content gs-slide-left">
                <h2>Cultura & Estilo</h2>
                <p>En WESTSIDE combinamos streetwear + barbería 
para darte un cambio real.

Te ves mejor. Te sentís distinto.</p>
                <div class="image-box">
                    <img src="/images/barberia/Barber-logo-2.png" alt="logo Barbería Westside">
                </div>
            </div>
            <div class="image-content gs-slide-right">
                <img src="/images/barberia/Barber1.jpeg" alt="Westside Barbería">
            </div>
        </div>
    </section>


    <!-- 6. Catálogo de Productos -->
    <section id="catalogo" class="catalog-section">
        <div class="container text-center">
            <h2 class="gs-fade-up">Catálogo Visual</h2>
            
            <div class="carousel-wrapper">
                <button class="carousel-btn prev" onclick="document.getElementById('product-carousel').scrollBy({left: -330, behavior: 'smooth'})">❮</button>
                
                <div class="carousel-container" id="product-carousel">
                    
                    {{-- CÓDIGO DINÁMICO (De prueba, no se usa)
                    @foreach ($productos as $producto)
                        <div class="product-card gs-fade-up">
                            <!-- Mostramos la imagen (Si no hay foto, ponemos la de tu web por defecto) -->
                            @if($producto->imagen_frente)
                                <img src="{{ $producto->imagen_frente }}" alt="{{ $producto->nombre }}">
                            @else
                                <div class="placeholder-img">Falta Foto</div>
                            @endif

                            <div class="product-info">
                                <!-- Mostramos el Título y ahora sumamos el Precio! -->
                                <h4>{{ $producto->nombre }}</h4>
                                <p class="product-price" style="font-weight: bold; margin-top: 5px;">
                                    $ {{ number_format($producto->precio, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    --}}

                    <!-- PRODUCTOS ESTÁTICOS -->
                    @include('partes.productos_estaticos')

                </div>
                
                <button class="carousel-btn next" onclick="document.getElementById('product-carousel').scrollBy({left: 330, behavior: 'smooth'})">❯</button>
            </div>

            <!-- Botón hacia el catálogo completo -->
            <div class="btn-catalog-action gs-fade-up">
                <a href="/catalogo" class="btn-primary">VER CATÁLOGO COMPLETO</a>
            </div>
        </div>
    </section>

    <!-- 3. Comercialización -->
    <section id="comercializacion" class="comercial-section">
        <div class="container text-center">
            <h2 class="gs-fade-up">Cómo Trabajamos</h2>
            <div class="steps-grid">
                <div class="step-card gs-fade-up">
                    <div class="step-icon">1</div>
                    <h3>Venta Minorista</h3>
                    <p>Adquiere nuestras prendas exclusivas directamente desde nuestra sucursal o con envío a todo el país.</p>
                </div>
                
                <div class="step-card gs-fade-up">
                    <div class="step-icon">2</div>
                    <h3>Barbería</h3>
                    <p>Turnos presenciales con profesionales de primer nivel. Experiencia premium asegurada.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Consultas -->
    <section id="consultas" class="contact-section">
        <div class="form-container gs-reveal">
            <h2>Dejanos tu Consulta</h2>
            <form action="#" method="POST" class="contact-form">
                <div class="input-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre">
                </div>
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com">
                </div>
                <div class="input-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" rows="4" placeholder="Escribe tu consulta aquí..."></textarea>
                </div>
                <!-- Botón de submit sin validación js requerida por usuario -->
                <button type="submit" class="btn-primary btn-full">Enviar Consulta</button>
            </form>
        </div>
    </section>

    @include('partes.footer')

</body>
</html>
