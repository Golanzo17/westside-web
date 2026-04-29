# El Sistema de Layouts en Laravel Blade

Uno de los principios más importantes en programación es **DRY** (*Don't Repeat Yourself* - No repitas código). 

Antes del refactor, cada una de nuestras páginas (`Catalogo`, `Turnos`, `Consultas`, etc.) tenía repetida la misma estructura básica de HTML:

```html
<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">
    @include('partes.bg-watermark')
    @include('partes.nav')

    <!-- Aquí iba el contenido único de la página -->

    @include('partes.footer')
</body>
</html>
```

Esto era un problema: si queríamos agregar un banner global o cambiar la clase del `<body>`, teníamos que abrir 8 archivos distintos y hacer el mismo cambio 8 veces.

## La solución: `@extends` y `@yield`

Para solucionar esto, implementamos el sistema nativo de plantillas de Blade creando un **"Layout Maestro"**.

### 1. El Layout (`layouts/app.blade.php`)
Creamos un archivo base que contiene toda la estructura que se repite. En lugar de poner contenido, dejamos un "hueco" usando `@yield('content')`.

```html
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">
    @include('partes.bg-watermark')
    @include('partes.nav')

    <!-- Aquí Laravel inyectará el contenido de las otras páginas -->
    @yield('content')

    @include('partes.footer')
</body>
</html>
```

### 2. Las Vistas (ej: `Consultas.blade.php`)
Ahora, nuestras páginas ya no necesitan declarar el HTML básico. Simplemente "extienden" (heredan) del layout maestro y dicen qué contenido debe ir en el hueco llamado `content`.

```html
<!-- resources/views/Consultas.blade.php -->
@extends('layouts.app')

@section('content')
    
    <!-- Todo lo que pongamos acá adentro 
         aparecerá automáticamente entre el Nav y el Footer -->
         
    <section class="consultas-hero">
        <h1>Consultas</h1>
    </section>

@endsection
```

## Beneficios Inmediatos

1. **Mantenibilidad:** Si hay que agregar un script de Google Analytics en el footer, se edita un solo archivo y aplica a todo el sitio instantáneamente.
2. **Limpieza:** Los archivos Blade pasaron de tener 200 líneas a solo tener el contenido que realmente importa.
3. **Estándar de la industria:** Cualquier desarrollador de Laravel que entre a trabajar en este proyecto va a buscar la carpeta `layouts` inmediatamente. Es la forma oficial de trabajar.


