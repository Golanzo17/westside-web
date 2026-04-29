<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">

    @include('partes.bg-watermark')
    @include('partes.nav')

    @yield('content')

    @include('partes.footer')

    <script>
        // Re-scrollea al anchor después del renderizado completo en todo el sitio
        window.addEventListener('load', function () {
            if (window.location.hash) {
                const target = document.querySelector(window.location.hash);
                if (target) {
                    setTimeout(() => {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 80);
                }
            }
        });
    </script>
</body>
</html>
