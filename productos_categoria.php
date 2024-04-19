<?php
include 'includes/header.php';
include 'conexion.php';
?>
<link rel="stylesheet" href="css/styleH.css">

<nav>
    <a href="index.php">Inicio</a>
    <a href="ropa_hombre.php">Ropa de Hombre</a>
    <a href="ropa_Mujer.php">Ropa de Mujer</a>
    <a href="#">Iniciar Sesión</a>
    <a href="carrito.php">Carrito</a>
</nav>

<?php
// Obtén el id de la categoría desde el parámetro en la URL
$id_categoria = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_categoria) {
    $result_productos = $conn->query("SELECT * FROM productos WHERE Id_Categoria = $id_categoria");

    if ($result_productos->num_rows > 0) {
        // Agrupa los productos por nombre y color
        $productos_agrupados = [];
        $colores_procesados = [];

        while ($producto = $result_productos->fetch_assoc()) {
            $nombre = $producto['Nombre'];
            $color = $producto['color'];
            $descripcion = $producto['Descripcion'];
            $precio = $producto['Precio'];

            // Verifica si ya se procesó este color para este nombre
            if (!isset($colores_procesados[$nombre][$color])) {
                if (!isset($productos_agrupados[$nombre])) {
                    $productos_agrupados[$nombre] = [];
                }

                // Agrega información del producto incluyendo el precio
                $producto_con_precio = $producto;
                $producto_con_precio['Precio'] = $precio;
                $productos_agrupados[$nombre][] = $producto_con_precio;
                $colores_procesados[$nombre][$color] = true;
            }
        }

        // Obtener tallas únicas
        $tallas_unicas = [];
        foreach ($productos_agrupados as $productos) {
            foreach ($productos as $producto) {
                $talla = $producto['talla'];
                if (!in_array($talla, $tallas_unicas)) {
                    $tallas_unicas[] = $talla;
                }
            }
        }

        // Muestra los productos agrupados
        echo "<div class='productos-container'>";
        foreach ($productos_agrupados as $nombre => $productos) {
            echo "<div class='producto'>";
            // Muestra la imagen del primer producto para este nombre
            echo "<img id='imagen-producto' src='{$productos[0]['imagen']}' alt='$nombre'>";
            echo "<h3>$nombre</h3>";
            echo "<h5>$descripcion</h5>";

            // Lista desplegable para colores
            echo "<label for='color'>Color:</label>";
            echo "<select name='color' id='color' onchange='actualizarImagen(this)'>";
            foreach ($productos as $producto) {
                echo "<option value='{$producto['color']}'>{$producto['color']}</option>";
            }
            echo "</select>";

            // Lista desplegable para tallas
            echo "<label for='talla'>Talla:</label>";
            echo "<select name='talla' id='talla'>";
            foreach ($tallas_unicas as $talla) {
                echo "<option value='{$talla}'>{$talla}</option>";
            }
            echo "</select>";

            // Muestra el precio
            echo "<p>Precio: {$productos[0]['Precio']} USD</p>";

            // Botón de agregar al carrito
            echo "<button onclick='agregarAlCarrito({$productos[0]['Id_Producto']})'>Agregar al Carrito</button>";

            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No hay productos disponibles en esta categoría.</p>";
    }
} else {
    echo "<p>Error: No se proporcionó una categoría válida.</p>";
}
?>

<script>
function actualizarImagen(selectColor) {
    // Obtiene el valor seleccionado en el menú desplegable de colores
    var colorSeleccionado = selectColor.value;

    // Actualiza la fuente de la imagen
    document.getElementById('imagen-producto').src = `ruta_de_imagen_${colorSeleccionado}.jpg`;
}
</script>

<?php
include 'includes/footer.php';
?>
