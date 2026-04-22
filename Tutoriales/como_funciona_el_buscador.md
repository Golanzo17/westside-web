# ¿Cómo funciona el Buscador del Catálogo?

En la página de `Catalogo.blade.php` implementamos un buscador asíncrono o dinámico utilizando "Vanilla JavaScript" (que significa código JavaScript estándar y puro sin librerías de terceros). A diferencia de una búsqueda tradicional que requiere recargar la página e ir a la base de datos de Laravel, esta opción filtra las prendas que *ya están renderizadas* en pantalla directamente en tu navegador. Esto lo hace impresionantemente rápido.

A continuación, la explicación punto por punto:

## 1. El Input de Búsqueda de HTML

```html
<input type="text" id="productSearch" class="search-field" placeholder="Buscar producto por nombre...">
```
El campo donde el usuario escribe el nombre de la prenda requiere un ID único llamado `productSearch`. Mediante este ID, interconectamos el visual (HTML) con la lógica (JavaScript).

## 2. Escuchando al Usuario (El Evento 'Input')

```javascript
document.getElementById('productSearch').addEventListener('input', function() {
    // Lógica aquí adentro...
});
```
Con la función `addEventListener('input', ...)` le indicamos al navegador que se quede observando el campo permanentemente. Cada vez que el cliente presione una tecla, borre un caracter, o incluso copie/pegue un texto grande, todo el código interno se evalúa automáticamente. Gracias a esto, no hace falta que cliquen en ningún botón de "Buscar".

## 3. Configurando las Variables Iniciales

```javascript
let searchTerm = this.value.toLowerCase().trim();
let products = document.querySelectorAll('#catalog-products .product-card');
let visibleCount = 0;
```
- **`searchTerm`**: Es el término capturado. Lo agarramos usando `this.value`. Luego invocamos `.toLowerCase()` para pasar los caracteres a letra minúscula y `trim()` para eliminar espacios en blanco sobrantes a la izquierda y derecha. Así, si el usuario escribe distraído de esta forma: " BuZo ", el código va a buscar la palabra precisa: "buzo", facilitando el cruce de coincidencias.
- **`products`**: Buscamos en todo el archivo a todas las cajas o tarjetas que tengan la clase `.product-card` y las guardamos en un gran grupo.
- **`visibleCount`**: Iniciamos esta variable en el nivel `0`. Ella será nuestra contadora para saber si quedó alguna ropa visible después del filtrado.

## 4. Analizando Ropa por Ropa 

El ciclo lógico llamado `forEach` se encarga de recorrer todas las prendas reunidas en nuestra variable `products`, y se detiene una por una para ver si cumplen la condición:

```javascript
products.forEach(function(product) {
    // 1. Agarra el h4 particular de ESTE producto (que tiene el nombre)
    let titleElement = product.querySelector('.product-info h4');
    
    if (titleElement) {
        // 2. Pasamos el título estricto del producto también a minúsculas
        let title = titleElement.innerText.toLowerCase();

        // 3. Verificamos: ¿El título incluye lo que el usuario quiere?
        if (title.includes(searchTerm)) {
            // SÍ: Le sacamos el display:none para que se vea normal
            product.style.display = ''; 
            visibleCount++; // ¡Anotamos 1 en nuestra pizarra de conteo!
        } else {
            // NO: Lo ocultamos aplicando estilo none por CSS
            product.style.display = 'none'; 
        }
    }
});
```

El truco de que el usuario haya sido convertido a base de minúsculas y el título del artículo original ("Buzo Altered Black" ---> "buzo altered black") también esté transformado, es que JavaScript jamás va a arrojar error por diferenciar mayúsculas y minúsculas y encontrará tu producto infaliblemente bajo la regla estricta de `.includes(searchTerm)`.

## 5. El "Error" si no hay mercancía

```javascript
// Llamamos mediante un Id a nuestro mensaje oculto del HTML
let noProductsMessage = document.getElementById('noProductsMessage');

// Si la pizarra quedó en 0 significa que se ocultó todo
if (visibleCount === 0) {
    noProductsMessage.style.display = 'block'; // Mostramos el error
} else {
    noProductsMessage.style.display = 'none'; // Caso contrario sigue invisible
}
```

Si por ejemplo el usuario tipeó el texto "medias", el script hará un `product.style.display = 'none'` en ABSOLUTAMENTE TODAS las ropas y finalizará. Al finalizar nos daremos cuenta que la variable `visibleCount` jamás fue alterada y vale `0`. 

Ahí es donde el código decide iluminar nuestro div oculto de alerta de color gris informando amigablemente: `No se encontraron productos...`.

¡Esa es básicamente la magia front-end del buscador!
