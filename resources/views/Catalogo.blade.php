<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">

    <div class="bg-watermark">WESTSIDE</div>

    @include('partes.nav')

    <!-- Encabezado del catálogo -->
    <section class="catalog-header-main">
        <div class="container">
            <h2>Catálogo</h2>
            
            <!-- Barra de Búsqueda -->
            <div class="search-wrapper">
                <input type="text" id="productSearch" class="search-field" placeholder="Buscar producto por nombre...">
            </div>
        </div>
    </section>

    <!-- Grilla de Productos -->
    <section id="catalogo" class="catalog-section catalog-page-container">
        <div class="container">
            <div class="products-grid" id="catalog-products">
                @include('partes.productos_estaticos')
            </div>
            
            <!-- Mensaje de no encontrado -->
            <div id="noProductsMessage" class="message-not-found">
                <h4>No se encontraron productos que coincidan con tu búsqueda.</h4>
            </div>
        </div>
    </section>

    @include('partes.footer')

    <script>
        document.getElementById('productSearch').addEventListener('input', function() {
            let searchTerm = this.value.toLowerCase().trim();
            let products = document.querySelectorAll('#catalog-products .product-card');
            let visibleCount = 0;
            
            products.forEach(function(product) {
                // Buscamos el h4 dentro de product-info
                let titleElement = product.querySelector('.product-info h4');
                
                if (titleElement) {
                    let title = titleElement.innerText.toLowerCase();
                    if (title.includes(searchTerm)) {
                        product.style.display = ''; // Omitimos 'block' explícito para usar el default flex/grid
                        visibleCount++;
                    } else {
                        product.style.display = 'none';
                    }
                }
            });

            // Mostrar mensaje si no hay productos visibles
            let noProductsMessage = document.getElementById('noProductsMessage');
            if (visibleCount === 0) {
                noProductsMessage.style.display = 'block';
            } else {
                noProductsMessage.style.display = 'none';
            }
        });
    </script>
</body>
</html>
