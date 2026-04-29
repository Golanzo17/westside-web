# 📋 Guía para el Profesor — Cómo levantar el proyecto Westside

Hola! Este archivo explica paso a paso cómo instalar y ejecutar el proyecto para poder verlo en su totalidad.



---

## ✅ Requisitos previos

- **Laravel Herd** — para servir la aplicación
- **Composer** — para instalar dependencias de PHP ([getcomposer.org](https://getcomposer.org))

> ⚠️ **No hace falta tener Node.js instalado.** Los assets (CSS y JavaScript) ya vienen compilados en el repositorio.

---

## 🚀 Pasos para levantar el proyecto

### Paso 1 — Clonar o descargar el repositorio

```bash
git clone https://github.com/[usuario]/westside.git
```

O descargar el ZIP desde GitHub y descomprimirlo.

---

### Paso 2 — Instalar dependencias de PHP

```bash
composer install
```

Descarga los paquetes de Laravel. Puede tardar un par de minutos la primera vez.

---

### Paso 3 — Crear el archivo de configuración

```bash
copy .env.example .env
php artisan key:generate
```

---

### Paso 4 — Agregar el proyecto a Laravel Herd

1. Abrir **Laravel Herd**
2. Ir a **Sites** → agregar la carpeta del proyecto
3. Herd asigna automáticamente una URL local, por ejemplo: `http://westside.test`
4. Abrir esa URL en el navegador

---



## ❓ Problemas frecuentes

**El sitio no tiene estilos (se ve todo blanco)**
→ Los assets ya vienen compilados en `/public/build`. Si aun así no cargan, asegurarse de que Herd esté apuntando a la carpeta correcta.

**Error "No application encryption key"**
→ Correr `php artisan key:generate`.

**Error de composer**
→ Verificar que Composer esté instalado corriendo `composer --version` en la terminal.

**La URL no carga**
→ Verificar que la carpeta esté correctamente agregada en Herd y que el nombre del site coincida con la URL.

---

## 🛠️ Para quien quiera modificar el proyecto

> ⚠️ Esta sección es solo si se quiere editar el código CSS o JavaScript. Para solo **ver** el proyecto, no hace falta nada de esto.

### ¿Cuándo hay que compilar los assets?

Este proyecto usa **Vite** para procesar y optimizar los archivos CSS y JavaScript. Vite toma los archivos de `resources/css/app.css` y `resources/js/app.js`, los procesa, y genera los archivos finales en `public/build/`.

**El navegador siempre carga los archivos de `public/build/`, no los de `resources/`.**

Esto significa que si se modifica `app.css` o `app.js`, el cambio **no se verá en el navegador** hasta que se recompile.

### ¿Cómo recompilar?

Necesitás tener **Node.js** instalado ([nodejs.org](https://nodejs.org)).

Desde la terminal, dentro de la carpeta del proyecto:

```bash
# Instalar dependencias de Node (solo la primera vez)
npm install

# Compilar los assets para producción
npm run build
```

Después de `npm run build`, recargar la página en el navegador.

### Modo desarrollo (hot reload)

Si estás trabajando activamente en el CSS, podés usar el modo dev que actualiza el navegador automáticamente cada vez que guardás un archivo:

```bash
npm run dev
```

> ⚠️ Mientras `npm run dev` esté corriendo, **no cerres esa terminal**. Si la cerrás y el archivo `public/hot` queda sin eliminar, el sitio perderá los estilos. En ese caso, eliminá manualmente el archivo `public/hot` o corré `npm run build`.

---

*Proyecto Westside — Streetwear & Barbería | Desarrollado con Laravel + Vite*
