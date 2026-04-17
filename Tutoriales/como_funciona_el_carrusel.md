# Tutorial: ¿Cómo funciona nuestro Carrusel de Productos?

Este documento explica paso a paso cómo transformamos una simple grilla de productos estáticos en un **carrusel dinámico, moderno y fluido** utilizando únicamente HTML, CSS puro y una línea muy pequeña de JavaScript nativo, sin depender de librerías pesadas como Bootstrap, Swiper o Tailwind.

---

## 1. La Estructura HTML (Principal.blade.php)

Para que el carrusel funcione, necesitamos un contenedor principal que envuelva a todas las tarjetas de nuestros productos. Si miras la sección del Catálogo Visual, verás la siguiente estructura:

```html
<div class="carousel-wrapper">
    <!-- Botón Anterior -->
    <button class="carousel-btn prev" onclick="document.getElementById('product-carousel').scrollBy({left: -330, behavior: 'smooth'})">❮</button>
    
    <!-- Contenedor del Carrusel -->
    <div class="carousel-container" id="product-carousel">
        @include('partes.productos_estaticos')
    </div>
    
    <!-- Botón Siguiente -->
    <button class="carousel-btn next" onclick="document.getElementById('product-carousel').scrollBy({left: 330, behavior: 'smooth'})">❯</button>
</div>
```

**¿Qué hace cada parte?**
- `carousel-wrapper`: Es la caja exterior. Sirve principalmente para tener una referencia espacial donde "anclar" (posicionar) los botones flotantes de avance y retroceso.
- `carousel-container`: Es el corazón del carrusel. Todas nuestras `product-card` (tarjetas) se inyectan acá adentro gracias al `@include`. A este elemento le damos el identificador `id="product-carousel"` para que los botones sepan exactamente a quién deben mover.
- **Los Botones `<button>`**: Tienen un evento `onclick` nativo. La instrucción `scrollBy` le dice a la ventana del carrusel que se desplace 330 píxeles hacia la izquierda (negativo) o derecha (positivo). La propiedad `behavior: 'smooth'` asegura que el deslizamiento tenga una animación suave en lugar de saltar agresivamente.

---

## 2. La Magia de CSS (app.css)

Toda la distribución y la sensación táctil de "App Moderna" sucede en el CSS gracias a propiedades relativamente nuevas como `scroll-snap-type`. 

### A. Alineación en fila (Contenedor)

```css
.carousel-container {
  display: flex;
  overflow-x: auto;
  gap: 30px;
  scroll-behavior: smooth;
  scroll-snap-type: x mandatory;
}
```

- `display: flex`: Convierte el contenedor en una fila. Obliga a todas las tarjetas a ubicarse una al lado de la otra.
- `overflow-x: auto`: Le avisa al navegador que si las tarjetas superan el ancho de la pantalla, debe agregar una barra espaciadora horizontal para permitir deslizamiento lateral (scroll).
- **El factor secreto - `scroll-snap-type: x mandatory;`**: Esta es la propiedad que da el efecto "magnético". Obliga a que al terminar de desplazar con el dedo o arrastrar, el contenedor siempre detenga su movimiento "encajando" perfectamente una tarjeta en la pantalla, evitando que la tarjeta quede frenada por la mitad.

### B. Geometría de las tarjetas

```css
.carousel-container > .product-card {
  flex: 0 0 300px;
  scroll-snap-align: start;
}
```

- `flex: 0 0 300px;`: Una regla sagrada en los carruseles. Evita que las tarjetas intenten encogerse o estirarse (`flex-shrink: 0`, `flex-grow: 0`) y les clava un ancho base de estricto de 300 píxeles por tarjeta. De esta manera el navegador no deforma los elementos cuando se quedan sin pantalla.
- `scroll-snap-align: start;`: Complementa la regla "magnética" del componente padre. Le indica a la tarjeta que, cuando la pantalla pare de hacer scroll, el margen izquierdo (`start`) de la tarjeta en foco debe alinearse perfectamente con el lado izquierdo de nuestra pantalla. 

---

## 3. ¿Por qué usamos `npm run build`?

En Laravel 11 se utiliza una herramienta poderosa que se llama **Vite** para procesar los estilos (CSS) y los scripts (JS).

Cuando modificamos el archivo raíz `resources/css/app.css` agregando las instrucciones Flexbox del carrusel, el navegador no podía leer esos cambios automáticamente si estabas en un estado "estático" o de "producción". Tu entorno seguía inyectando una cajita vieja de CSS que estaba compilada en tu carpeta de `public/build/assets/`.

Al ejecutar **`npm run build`** en la terminal:
1. Vite agarra todo el CSS que escribimos en `resources/css/app.css`.
2. Lo comprime y lo optimiza removiendo espacios innecesarios.
3. Lo inyecta actualizado en `public/build/...` (la carpeta que usa tu web para leer lo que realmente va a ver el cliente).

Por eso, la próxima vez que alteres un estilo en `app.css` y no se vea, recordá simplemente abrir la consola (CMD o Powershell) en la carpeta de tu código y ejecutar `npm run build` o mantener activo `npm run dev` para que sincronice automáticamente mientras trabajás.
