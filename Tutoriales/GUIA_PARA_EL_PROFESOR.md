# 📋 Guía para el Profesor — Cómo levantar el proyecto Westside

Hola! Este archivo explica paso a paso cómo instalar y ejecutar el proyecto para poder verlo en su totalidad.

**Tiempo estimado:** 5 a 10 minutos (la primera vez).

---

## ✅ Requisitos previos

Antes de empezar, asegurarse de tener instalado:

- **Laravel Herd** — para servir la aplicación Laravel
- **Node.js** — para compilar el CSS y JavaScript ([descargar en nodejs.org](https://nodejs.org))
- **Composer** — para instalar las dependencias de PHP ([descargar en getcomposer.org](https://getcomposer.org))

---

## 🚀 Pasos para levantar el proyecto

### Paso 1 — Clonar o descargar el repositorio

```bash
git clone https://github.com/[usuario]/westside.git
```

O descargar el ZIP desde GitHub y descomprimirlo.

---

### Paso 2 — Abrir la carpeta del proyecto en la terminal

Navegá hasta la carpeta donde quedó el proyecto. Todos los comandos siguientes se ejecutan desde ahí.

---

### Paso 3 — Instalar dependencias de PHP

```bash
composer install
```

Esto descarga todos los paquetes de Laravel. Puede tardar un par de minutos la primera vez.

---

### Paso 4 — Crear el archivo de configuración

```bash
copy .env.example .env
```

Luego generá la clave de la aplicación:

```bash
php artisan key:generate
```

---

### Paso 5 — Instalar dependencias de Node.js

```bash
npm install
```

Descarga Vite y todo lo necesario para compilar el CSS y JavaScript.

---

### Paso 6 — Compilar el CSS y JavaScript ⚠️ IMPORTANTE

```bash
npm run build
```

> **Este paso es obligatorio.** Sin él, la página se ve sin ningún estilo (todo blanco y sin diseño). Solo hace falta correrlo una vez.

---

### Paso 7 — Agregar el proyecto a Laravel Herd

1. Abrir **Laravel Herd**
2. Ir a **Sites** → **Add site** (o arrastrar la carpeta del proyecto)
3. Herd va a asignar automáticamente una URL local, por ejemplo: `http://westside.test`
4. Abrir esa URL en el navegador

---

## 🌐 Páginas del sitio

Una vez levantado, las páginas disponibles son:

| Página | URL |
|---|---|
| Principal | `http://westside.test/principal` |
| Quiénes Somos | `http://westside.test/quienes-somos` |
| Catálogo | `http://westside.test/catalogo` |
| Turnos | `http://westside.test/turnos` |
| Comercialización | `http://westside.test/comercializacion` |
| Términos y Usos | `http://westside.test/terminos-y-usos` |
| Contacto | `http://westside.test/contacto` |

---

## ❓ Problemas frecuentes

**El sitio no tiene estilos (se ve todo blanco/básico)**
→ Correr `npm run build` nuevamente y recargar la página.

**Error "No application encryption key"**
→ Correr `php artisan key:generate`.

**La URL no carga en el navegador**
→ Verificar que la carpeta esté correctamente agregada en Herd y que el nombre del site coincida con la URL.

**Error de composer**
→ Verificar que Composer esté instalado corriendo `composer --version` en la terminal.

---

*Proyecto Westside — Streetwear & Barbería | Desarrollado con Laravel + Vite*
