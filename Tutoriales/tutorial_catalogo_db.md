# Documentación del Tutorial: Creación Dinaámica de Catálogo con Laravel

Este archivo es un resumen de todo el trabajo que hicimos paso a paso para transformar una página web estática (HTML "harcodeado") en un sistema dinámico conectado a una base de datos profesional. Esta es la base obligatoria de tu futuro carrito de compras en Westside.

---

## Conceptos Clave Aprendidos

- **Migración (`database/migrations/`):** Es el "plano de construcción" de la base de datos. Nos permite dictarle a la base de datos qué tablas y columnas debe crear, usando PHP en lugar de código SQL oscuro. Funciona como un historial que podemos deshacer y rehacer.
- **Modelo (`app/Models/`):** Es el "cerebro" en PHP que interactúa con las tablas. Si la tabla es un archivero, el Modelo es el empleado al que le pides "tráeme todas las remeras".
- **Seeder (`database/seeders/`):** Un archivo especial que usamos para "plantar" o poblar datos iniciales falsos o reales rápido con un comando, útil principalmente en fases de desarrollo antes de construir paneles administrativos visuales.
- **`nullable()`:** Palabra clave en migraciones que permite que un campo de la base de datos sea opcional (puede llegar vacío).
- **Rutas Relativas (`/images/...`)**: Forma profesional y segura de vincular imágenes o archivos para asegurar que la web funcione en cualquier computadora/servidor externo. Nada de `C:\Users\...`.

---

## Resumen del Flujo de Trabajo y Comandos

### 1. Creación de Estructuras Iniciales
La regla principal es que los padres (Categorías) deben existir antes de los hijos (Productos) para luego poder relacionarlos. Ejecutamos estos comandos:
```bash
php artisan make:model Categoria -m
php artisan make:model Producto -m
```

### 2. Edición de Migraciones (Planos)
Definimos qué atributos tiene cada tabla:
- **Categorías:** Agregamos `$table->string('nombre');`
- **Productos:**
  - Creamos la conexión (Llave Foránea): `$table->foreignId('categoria_id')->constrained('categorias');`
  - Agregamos textos opcionales: `$table->text('descripcion')->nullable();`
  - Agregamos números de precios: `$table->decimal('precio', 10, 2);` *(Hasta diez dígitos, con 2 décimales asegurados).*
  - Agregamos las tres fotos (Opcionales): `$table->string('imagen_frente')->nullable();`
  - Agregamos inventario (A futuro): `$table->integer('stock')->default(0);`

### 3. Seguridad de Modelos 
Para permitir que Laravel inserte datos rápidos directamente desde el Seeder bajamos las defensas de validación. 
Dentro de `app/Models/Categoria.php` y `app/Models/Producto.php` insertamos la línea:
```php
protected $guarded = [];
```

### 4. Sembrado de Datos (Creación Manual)
En `database/seeders/DatabaseSeeder.php` definimos la rutina completa, guardando variables por Categoría e insertándolas como `categoria_id` en las listas del Producto.

**Fórmula clave para memorizar al agregar productos nuevos:**
1. Haces tus cambios en el archivo `DatabaseSeeder.php`. (⚠️ SIEMPRE presionas `Ctrl + S` para guardar en disco).
2. Vas a la terminal y ejecutas el Súper Comando (destruye lo viejo, aplica el código nuevo y carga los nuevos productos desde cero):
```bash
php artisan migrate:fresh --seed
```

### 5. Conectar Base de Datos al Frontend (Blade)
Remplazamos el portero estático `routes/web.php` para que busque los productos antes de imprimir la pantalla:
```php
use App\Models\Producto;
// ...
$productos = Producto::all();
return view('Principal', compact('productos'));
```

Y en el archivo visual `resources/views/Principal.blade.php`, usamos la sintaxis dinámica `@foreach ($productos as $producto)` para iterar los bloques HTML.  De esta forma una única plantilla en Blade sirvió para cargar los decenas de productos que se obtienen de la base de datos.
Usamos la función `number_format($producto->precio, 0, ',', '.')` para darle un formato de moneda visual ideal.

---

🌟 **Progreso logrado:** El Catálogo de Productos y las Bases de Datos quedaron funcionalmente atados, versionados en Git, y se dejó la infraestructura 100% preparada para, el día de mañana, añadir la manipulación directa de carritos de inventario real (resta de `stock`).
