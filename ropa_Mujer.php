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
    <h2>Ropa de Mujer</h2>

    <!-- Menú de Categorías para Mujeres -->
    <?php
    $result_categorias_mujer = $conn->query("SELECT * FROM categoria WHERE genero = 'Mujer'");
    if ($result_categorias_mujer->num_rows > 0) {
        while ($row = $result_categorias_mujer->fetch_assoc()) {
            echo "<div>";
            echo "<img src='{$row['Imagen']}' alt='{$row['Nombre_Categoria']}'>";
            echo "<h3>{$row['Nombre_Categoria']}</h3>";
            echo "<a href='productos_categoria.php?id={$row['Id_Categoria']}' class='ver-productos-btn'>Ver Productos</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay categorías disponibles para mujeres.</p>";
    }
    ?>
</section>

<?php
include 'includes/footer.php';
?>
