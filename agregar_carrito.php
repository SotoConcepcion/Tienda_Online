<?php
session_start();
include 'conexion.php';

if (isset($_POST['id_producto'])) {
    $idProducto = $_POST['id_producto'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (!in_array($idProducto, $_SESSION['carrito'])) {
        $_SESSION['carrito'][] = $idProducto;

        $idUsuario = (isset($_SESSION['Id_cliente'])) ? $_SESSION['Id_cliente'] : null;
        $cantidad = 1;

        $conn->query("INSERT INTO carrito (Id_cliente, Id_Producto, cantidad) VALUES ($idUsuario, $idProducto, $cantidad)");

        echo "Producto agregado al carrito.";
    } else {
        echo "El producto ya está en el carrito.";
    }
} else {
    echo "Error: No se proporcionó un producto válido.";
}
?>
