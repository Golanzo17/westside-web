# Preguntas de Examen — Taller de Programación
### Proyecto Westside · Preparación para defensa oral

---

## SECCIÓN 1 — Catálogo: Buscador y Filtros

---

### Pregunta 1
**¿Por qué conviene tener una sola función `filterProducts()` para el buscador y los chips de filtro, en lugar de dos funciones separadas?**

**Respuesta:**
Porque tanto el buscador como los filtros hacen la misma operación: recorrer todas las tarjetas y decidir cuál mostrar u ocultar según dos criterios (texto de búsqueda + categoría activa). Si tuviéramos dos funciones separadas, estaríamos duplicando lógica. Si mañana cambia la forma de filtrar, habría que modificar dos lugares.

El principio detrás de esto se llama **DRY** ("Don't Repeat Yourself"): no repitas código que hace lo mismo. Una sola función que lee el estado actual de ambos controles (buscador + chip activo) es más limpia y fácil de mantener.

```js
// Ambos eventos llaman a la misma función
document.querySelectorAll('.filter-chip').forEach(chip =>
    chip.addEventListener('click', filterProducts)
);
document.getElementById('productSearch').addEventListener('input', filterProducts);
```

---

### Pregunta 2
**En `filterProducts()`, se usa `card.getAttribute('data-category')`. ¿Dónde se define ese atributo y qué pasa si un producto no lo tiene?**

**Respuesta:**
El atributo `data-category` se define directamente en el HTML de cada tarjeta de producto:

```html
<div class="product-card" data-category="remeras">
```

Los atributos que empiezan con `data-` son atributos HTML personalizados llamados **Data Attributes**. Sirven para guardar información en el HTML que después JavaScript puede leer con `getAttribute('data-category')`.

Si un producto no tiene ese atributo, `getAttribute('data-category')` devuelve `null`. En el código hay una protección para eso:

```js
const category = card.getAttribute('data-category') || '';
```

El `|| ''` hace que si el valor es `null`, se use una cadena vacía. Así el producto nunca matchea ningún filtro de categoría (salvo "Todos"), evitando que el código rompa.

---

### Pregunta 3
**Explicá estas tres líneas:**
```js
const matchS = !search || title.includes(search);
const matchF = active === 'all' || category === active;
if (matchS && matchF) { ... }
```

**Respuesta:**

- **`matchS`** (match de búsqueda): Es `true` si el campo de búsqueda está vacío (`!search`) O si el título del producto contiene el texto buscado (`title.includes(search)`). Si el campo está vacío, no hay nada que filtrar, entonces todos pasan.

- **`matchF`** (match de filtro): Es `true` si el chip activo es "Todos" (`active === 'all'`) O si la categoría del producto coincide con el chip seleccionado.

- **`if (matchS && matchF)`**: El producto se muestra solo si PASA AMBAS condiciones al mismo tiempo. Podés buscar "buzo" y además tener el filtro "Buzos" activo, y solo verías los buzos que coincidan con "buzo" en el nombre.

**Analogía:** Es como un portero que te deja entrar solo si tenés invitación (matchS) Y también tenés el traje correcto (matchF). Si fallás una sola condición, no entrás.

---

### Pregunta 4
**¿Por qué el contador tiene `visible !== 1 ? 's' : ''`?**

**Respuesta:**
Para manejar correctamente el singular y el plural en español.

- Si hay 1 producto → "1 producto" (sin s)
- Si hay 0 o más de 1 → "0 productos", "10 productos" (con s)

Sin esa condición, siempre diría "1 productos", lo cual es gramaticalmente incorrecto. Es un detalle pequeño pero marca la diferencia en la calidad del producto.

```js
visible + ' producto' + (visible !== 1 ? 's' : '')
// visible = 1 → "1 producto"
// visible = 5 → "5 productos"
// visible = 0 → "0 productos"
```

---

## SECCIÓN 2 — Animaciones: IntersectionObserver

---

### Pregunta 5
**Las tarjetas empiezan invisibles y aparecen al hacer scroll. ¿Cómo funciona el `IntersectionObserver`?**

**Respuesta:**
Un `IntersectionObserver` es una API del navegador que **observa elementos** y te avisa cuando entran o salen del área visible de la pantalla (el "viewport").

En el catálogo funciona así:

1. Cada tarjeta empieza con `opacity: 0` (invisible) en el CSS.
2. El JS crea un observer y le dice: "avisame cuando cualquiera de estas tarjetas entre al viewport".
3. Cuando el usuario scrollea y una tarjeta aparece en pantalla, el observer dispara una función que agrega la clase `card-visible`.
4. Esa clase tiene `opacity: 1` y `transform: translateY(0)`, que en conjunto con `transition` en el CSS crea la animación suave de aparición.

```js
const cardObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {          // Si el elemento entró al viewport
            entry.target.classList.add('card-visible');
        }
    });
});
```

**¿Por qué no usar `scroll` event directamente?** Porque el evento `scroll` se dispara cientos de veces por segundo mientras scrolleás, lo que puede trabar el navegador. El `IntersectionObserver` es mucho más eficiente: solo se activa cuando hay un cambio real de visibilidad.

---

### Pregunta 6
**¿Por qué se llama `cardObserver.unobserve(card)` después de agregar la clase?**

**Respuesta:**
Porque una vez que la tarjeta ya se animó, no tiene sentido seguir observándola. La animación es de "entrada" — solo ocurre una vez.

Si no se llamara `unobserve()`, el observer seguiría vigilando esa tarjeta eternamente, consumiendo memoria y procesamiento innecesariamente. Además, si el usuario scrolleara hacia arriba y volviera a bajar, la tarjeta intentaría animarse de nuevo (aunque visualmente ya estaría en `opacity: 1`, podría causar comportamientos raros).

```js
if (entry.isIntersecting) {
    entry.target.classList.add('card-visible');
    cardObserver.unobserve(entry.target); // Dejar de observar → limpieza
}
```

---

### Pregunta 7
**¿Qué significa `threshold: 0` en el IntersectionObserver?**

**Respuesta:**
El `threshold` define **qué porcentaje del elemento tiene que ser visible** para que el observer se active.

- `threshold: 0` → Se activa cuando **apenas 1 pixel** del elemento entra al viewport.
- `threshold: 0.5` → Se activa cuando el **50%** del elemento es visible.
- `threshold: 1` → Se activa solo cuando el elemento es **completamente visible**.

En el catálogo se usa `0` para que la animación comience en cuanto la tarjeta empieza a asomar por el borde de la pantalla, dando una sensación de que "emergen" naturalmente mientras scrolleás.

---

## SECCIÓN 3 — Scrollytelling: Quiénes Somos

---

### Pregunta 8
**¿Qué propiedad CSS hace que la imagen quede fija mientras el texto se mueve?**

**Respuesta:**
La propiedad `position: sticky` en el contenedor de la imagen:

```css
.visual-wrapper {
    position: sticky;
    top: calc(var(--nav-height) + 10vh);
    height: 70vh;
}
```

`position: sticky` es un híbrido entre `relative` y `fixed`:
- Mientras el elemento está dentro de su contenedor padre, se comporta como `relative` (fluye con el documento).
- Cuando el usuario scrollea y el elemento llegaría a la posición `top` indicada, se "pega" ahí y queda fijo como si fuera `fixed`, hasta que el contenedor padre termine de ser visible.

**Resultado visual:** El texto de los pasos scrollea normalmente, pero la imagen queda anclada en el centro de la pantalla hasta que terminás de leer toda la historia.

---

### Pregunta 9
**¿Por qué el observer del scrollytelling usa `rootMargin: '-40% 0px -40% 0px'`?**

**Respuesta:**
El `rootMargin` modifica el área de detección del observer, como si "encogiera" el viewport. Con `-40% 0px -40% 0px`, el área de detección se reduce un 40% desde arriba y un 40% desde abajo.

**¿Para qué?** Para que el paso de texto se active cuando está en el **centro** de la pantalla, no cuando apenas empieza a ser visible.

Sin este margen (con `rootMargin: '0px'`), el texto se activaría en cuanto aparece por el borde inferior de la pantalla, mucho antes de que el usuario lo esté leyendo. Con `-40%`, el texto se ilumina cuando está frente a los ojos del usuario, generando una experiencia de lectura más natural.

```
Sin margen:          Con -40% top y bottom:
┌──────────────┐     ┌──────────────┐
│ ← activa acá │     │              │ (zona inactiva)
│              │     ├──────────────┤
│              │     │ ← activa acá │ (zona activa: 20% central)
│              │     ├──────────────┤
└──────────────┘     │              │ (zona inactiva)
                     └──────────────┘
```

---

### Pregunta 10
**¿Por qué `steps[0].classList.add('is-active')` se llama manualmente fuera del observer?**

**Respuesta:**
Porque el `IntersectionObserver` solo se dispara cuando hay un **cambio** de visibilidad. Al cargar la página, el primer paso ya está visible en el viewport desde el principio, pero como nunca "entró" (siempre estuvo ahí), el observer nunca lo detecta.

Sin esa línea, el primer párrafo aparecería apagado (`opacity: 0.2`) hasta que el usuario scrolleara hacia abajo y volviera, lo cual sería un bug visual.

```js
// El observer detecta CAMBIOS, no el estado inicial
// Por eso activamos el primer elemento manualmente:
if (steps.length > 0) {
    steps[0].classList.add('is-active');
}
```

---

## SECCIÓN 4 — Menú Hamburguesa

---

### Pregunta 11
**El botón ≡ se convierte en ✕ solo con CSS. ¿Cómo funciona eso?**

**Respuesta:**
El botón tiene tres elementos `<span>` (las tres líneas). Cuando se agrega la clase `is-open` al botón, el CSS transforma cada span individualmente:

```css
/* Línea de arriba: se mueve hacia abajo y gira 45° → forma la mitad de la X */
.nav-hamburger.is-open span:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
}

/* Línea del medio: desaparece */
.nav-hamburger.is-open span:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
}

/* Línea de abajo: se mueve hacia arriba y gira -45° → forma la otra mitad de la X */
.nav-hamburger.is-open span:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
}
```

El `7px` es exactamente la distancia entre las líneas (gap: 5px + height: 2px ≈ 7px), así las dos líneas se cruzan perfectamente en el centro formando una ✕. Y como los spans tienen `transition`, el cambio se anima suavemente.

---

### Pregunta 12
**¿Por qué se bloquea el scroll del body con `overflow: hidden` cuando el menú está abierto?**

**Respuesta:**
Porque el menú es un overlay de pantalla completa (`position: fixed; inset: 0`). Si el scroll no estuviera bloqueado, el usuario podría seguir scrolleando el contenido de la página detrás del menú sin verlo, perdiendo su posición en la página.

Además sería confuso: el menú está "encima" de todo, pero el fondo estaría moviéndose, dando una sensación de inestabilidad visual.

```css
body.menu-open {
    overflow: hidden; /* Bloquea el scroll mientras el menú está abierto */
}
```

Cuando el menú se cierra, se remueve la clase `menu-open` del body y el scroll vuelve a funcionar normalmente.

---

## SECCIÓN 5 — Laravel y Blade

---

### Pregunta 13
**¿Cuál es la diferencia entre `@include` y `@extends`/`@yield`?**

**Respuesta:**

| `@include` | `@extends` + `@yield` |
|---|---|
| Inserta el contenido del partial en ese punto exacto | Define una "plantilla base" con huecos (`@yield`) que las páginas hijas rellenan |
| El partial no sabe nada del contexto donde se usa | La vista hija "hereda" toda la estructura del layout |
| Ideal para componentes reutilizables (nav, footer, etc.) | Ideal cuando TODAS las páginas comparten la misma estructura |
| No permite enviar contenido "hacia arriba" fácilmente | Permite `@push`/`@stack` para inyectar CSS/JS desde la vista hija al head |

**En este proyecto** se usa `@include` porque las páginas se construyen "de arriba a abajo": cada vista incluye sus partes. Es un enfoque válido, aunque para proyectos más grandes se prefiere el sistema de layouts con `@extends`.

---

### Pregunta 14
**`Route::redirect('/principal', '/')` — ¿Qué código HTTP devuelve? ¿Importa?**

**Respuesta:**
Por defecto, `Route::redirect()` en Laravel devuelve un **HTTP 302** (redirección temporal).

**Diferencia:**
- **301** (Permanente): Los buscadores como Google entienden que la URL cambió para siempre y actualizan su índice. Los browsers guardan el redirect en caché.
- **302** (Temporal): La URL original podría volver a funcionar en el futuro. Google sigue indexando ambas URLs.

**¿Importa en este caso?** Para este proyecto académico, no. Pero en un proyecto real con SEO, si `/principal` fue reemplazada definitivamente por `/`, habría que usar un 301 para que Google no indexe ambas páginas:

```php
Route::redirect('/principal', '/', 301); // Redirect permanente
```

---

### Pregunta 15
**`window.WSP` está definido en `head.blade.php` y se usa en otros archivos. ¿Por qué funciona sin importarlo?**

**Respuesta:**
Porque `window` es el **objeto global** de JavaScript en el navegador. Todo lo que se guarda en `window` es accesible desde cualquier script en la misma página, sin necesidad de importar nada.

```html
<!-- Se define en head.blade.php -->
<script>window.WSP = '5493795193973';</script>

<!-- Se usa en Catalogo.blade.php, líneas después -->
<script>
    const WSP_CAT = window.WSP; // ✅ Funciona porque window es global
</script>
```

Es como una variable "pública" que todos los scripts de la página pueden leer. La ventaja de usar `window.WSP` explícitamente (en lugar de solo `WSP`) es que queda claro que es una variable global intencional y no una variable local.

---

## SECCIÓN 6 — Pregunta Trampa 🪤

---

### Pregunta 16
**¿Por qué se usa `{!! $wspIcon !!}` en lugar de `{{ $wspIcon }}`? ¿Qué riesgo tiene?**

**Respuesta:**

**La diferencia:**
- `{{ $variable }}` → Blade **escapa** el HTML. Convierte caracteres como `<`, `>`, `"` en entidades HTML (`&lt;`, `&gt;`, `&quot;`). El SVG se mostraría como texto plano, no como un ícono.
- `{!! $variable !!}` → Blade imprime el HTML **sin escapar**, tal como está. El navegador lo interpreta como código HTML real.

**¿Por qué se necesita `{!! !!}` en este caso?**
Porque `$wspIcon` contiene una cadena de texto que es código HTML (un `<svg>`). Para que el navegador lo renderice como ícono, necesita que Blade no lo escape.

**¿Qué riesgo tiene?**
Es vulnerable a **XSS (Cross-Site Scripting)**: si un usuario malicioso pudiera controlar el valor de esa variable, podría inyectar JavaScript dañino en la página.

```php
// PELIGROSO si $wspIcon viniera de input del usuario:
{!! $wspIcon !!}

// SEGURO en este caso porque:
// 1. $wspIcon está definido directamente en el código PHP del servidor
// 2. Ningún usuario puede modificar su valor
```

**Regla de oro:** Usar `{!! !!}` solo cuando el contenido HTML viene de una fuente de confianza (código propio), NUNCA con datos que vengan del usuario.

---

## Conceptos Clave para Recordar

| Concepto | Qué es en una línea |
|---|---|
| `IntersectionObserver` | API del browser que avisa cuando un elemento entra/sale del viewport |
| `data-*` attributes | Atributos HTML personalizados para guardar datos que lee JavaScript |
| `position: sticky` | Elemento que fluye con el scroll hasta cierto punto, luego se "pega" |
| `DRY` | "Don't Repeat Yourself" — no duplicar lógica o código |
| `XSS` | Ataque donde un usuario malicioso inyecta JavaScript en tu página |
| `window` (JS) | Objeto global del browser; todo lo que está en él es accesible por cualquier script |
| `threshold` (Observer) | Porcentaje del elemento visible para disparar el callback |
| `rootMargin` (Observer) | Margen que expande o encoge el área de detección del observer |
| HTTP 301 vs 302 | 301 = redirect permanente, 302 = redirect temporal |
| `@include` vs `@extends` | Include inserta partials; extends hereda un layout completo |
