<?php
include 'includes/header.php';
include 'conexion.php'; // Asegúrate de incluir el archivo de configuración
?>
<link rel="stylesheet" href="css/styleH.css">

<nav>
    <a href="index.php">Inicio</a>
    <a href="ropa_hombre.php">Ropa de Hombre</a>
    <a href="ropa_Mujer.php">Ropa de Mujer</a>
    <a href="#">Iniciar Sesión</a>
    <a href="carrito.php">Carrito</a>
</nav>

<section>
    <h2>Ropa de Hombre</h2>

    <!-- Menú de Categorías para Hombres -->
    <?php
    $result_categorias_hombre = $conn->query("SELECT * FROM categoria WHERE genero = 'Hombre'");
    if ($result_categorias_hombre->num_rows > 0) {
        while ($row = $result_categorias_hombre->fetch_assoc()) {
            echo "<div>";
            echo "<img src='{$row['Imagen']}' alt='{$row['Nombre_Categoria']}'>";
            echo "<h3>{$row['Nombre_Categoria']}</h3>";
            echo "<a href='productos_categoria.php?id={$row['Id_Categoria']}' class='ver-productos-btn'>Ver Productos</a>";
            echo "</div>";
        }
        
    } else {
        echo "<p>No hay categorías disponibles para hombres.</p>";
    }
    ?>
</section>

<?php
include 'includes/footer.php';
?>
