<?php
// Incluir el archivo de operaciones CRUD
include 'crud.php';

// Obtener la lista de clientes
$clientes = obtenerClientes();

// Mostrar la lista de clientes (puedes usar HTML aquí para mostrar los datos)
foreach ($clientes as $cliente) {
    echo "ID Cliente: " . $cliente['id_cliente'] . ", Teléfono: " . $cliente['telefono'] . ", Correo: " . $cliente['correo'] . "<br>";
}
?>
