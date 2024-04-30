<?php
// Incluir el archivo de conexión a la base de datos
include 'conexiones.php';

// Función para crear un nuevo cliente
function crearCliente($telefono, $correo) {
    global $conex;

    $stmt = $conex->prepare("INSERT INTO cliente (telefono, correo) VALUES (?, ?)");
    $stmt->execute([$telefono, $correo]);
}

// Función para obtener todos los clientes
function obtenerClientes() {
    global $conex;

    $stmt = $conex->query("SELECT * FROM cliente");
    return $stmt->fetchAll();
}

// Función para actualizar la información de un cliente
function actualizarCliente($id_cliente, $telefono, $correo) {
    global $conex;

    $stmt = $conex->prepare("UPDATE cliente SET telefono = ?, correo = ? WHERE id_cliente = ?");
    $stmt->execute([$telefono, $correo, $id_cliente]);
}

// Función para eliminar un cliente
function eliminarCliente($id_cliente) {
    global $conex;

    $stmt = $conex->prepare("DELETE FROM cliente WHERE id_cliente = ?");
    $stmt->execute([$id_cliente]);
}

// Función para crear un nuevo vehículo
function crearVehiculo($id_cliente,  $modelo, $marca, $color) {
    global $conex;

    $stmt = $conex->prepare("INSERT INTO vehiculo (id_cliente, nombre_cliente, modelo, marca, color) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_cliente, $modelo, $marca, $color]);
}

// Función para obtener todos los vehículos
function obtenerVehiculos() {
    global $conex;

    $stmt = $conex->query("SELECT * FROM vehiculo");
    return $stmt->fetchAll();
}

// Función para actualizar la información de un vehículo
function actualizarVehiculo($id_vehiculo, $modelo, $marca, $color) {
    global $conex;

    $stmt = $conex->prepare("UPDATE vehiculo SET modelo = ?, marca = ?, color = ? WHERE id_vehiculo = ?");
    $stmt->execute([$modelo, $marca, $color, $id_vehiculo]);
}

// Función para eliminar un vehículo
function eliminarVehiculo($id_vehiculo) {
    global $conex;

    $stmt = $conex->prepare("DELETE FROM vehiculo WHERE id_vehiculo = ?");
    $stmt->execute([$id_vehiculo]);
}
?>
