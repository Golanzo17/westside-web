# SKILL: Experto en GSAP y Animaciones

## 🎯 Objetivo
Este conocimiento define las reglas estrictas de rendimiento y buenas prácticas que el agente debe seguir al escribir animaciones con GSAP para el proyecto Westside.

## 📏 Reglas de Código (Best Practices)
1. **Configuración Inicial:** Siempre incluye `gsap.registerPlugin(ScrollTrigger);` si la animación depende del scroll.
2. **Rendimiento:** Usa SIEMPRE alias de transformación (`x`, `y`, `rotation`, `scale`) en lugar de animar propiedades de layout como `top`, `left` o `margin`.
3. **Visibilidad:** Usa `autoAlpha: 0` o `autoAlpha: 1` en lugar de animar `opacity` y `display` por separado.
4. **Secuencias:** Si hay más de una animación encadenada, utiliza SIEMPRE `gsap.timeline()`. No utilices la propiedad `delay` para crear secuencias.
5. **ScrollTrigger:** Para animaciones vinculadas a secciones, utiliza configuraciones como `start: "top center"` y `scrub: true` si la animación debe seguir el ritmo del scroll del usuario.
6. **Entorno:** El proyecto utiliza Vanilla JavaScript dentro de vistas de Laravel Blade. **NO utilices hooks de React** (como `useGSAP`, `useEffect` o `useRef`). Selecciona los elementos directamente con sus clases de CSS (ej. `".panel"`, `".box"`).