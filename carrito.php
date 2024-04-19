<!-- Mostrar productos del carrito -->
<?php
session_start();
include 'conexion.php';

if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    $productosDelCarrito = obtenerProductosDelCarrito($_SESSION['carrito']);

    foreach ($productosDelCarrito as $productoCarrito) {
        echo "<div>";
        echo "<h3>{$productoCarrito['nombre']}</h3>";
        echo "<p>Cantidad: {$productoCarrito['cantidad']}</p>";
        echo "<form action='carrito.php' method='post'>";
        echo "<input type='hidden' name='id_producto' value='{$productoCarrito['Id_Producto']}'>";
        echo "<input type='number' name='cantidad' value='{$productoCarrito['cantidad']}'>";
        echo "<button type='submit' name='actualizar'>Actualizar</button>";
        echo "<button type='submit' name='eliminar'>Eliminar</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p>El carrito está vacío.</p>";
}

function obtenerProductosDelCarrito($idsProductos) {
    // Implementa la lógica para obtener detalles de los productos desde la base de datos
    $productos = [];
    foreach ($idsProductos as $idProducto) {
        // Consulta SQL para obtener detalles del producto por su ID
        // Ejemplo: $result = $conn->query("SELECT * FROM productos WHERE id_producto = $idProducto");
        // Agrega los resultados al array $productos
    }
    return $productos;
}

// Lógica para manejar actualizar y eliminar
if (isset($_POST['actualizar'])) {
    $idProducto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // Implementa la lógica para actualizar la cantidad del producto en el carrito
    // Actualiza $_SESSION['carrito'] y la tabla carrito según tu diseño
    $conn->query("UPDATE carrito SET cantidad = $cantidad WHERE Id_Producto = $idProducto");
}

if (isset($_POST['eliminar'])) {
    $idProducto = $_POST['id_producto'];

    // Implementa la lógica para eliminar el producto del carrito
    // Elimina de $_SESSION['carrito'] y la tabla carrito según tu diseño
    $conn->query("DELETE FROM carrito WHERE Id_Producto = $idProducto");
}
?>

<!-- Botón para Continuar con la Compra -->
<a href="checkout.php">Continuar con la Compra</a>
<link rel="stylesheet" href="css/carrito.css">