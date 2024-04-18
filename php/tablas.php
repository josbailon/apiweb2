<?php

// Configuración de la conexión a la base de datos
$dsn = "pgsql:host=localhost;dbname=proyecto";
$username = "postgres";
$password = "12345";

try {
    // Crear una nueva instancia de PDO
    $conex = new PDO($dsn, $username, $password);

    // Establecer el modo de error para lanzar excepciones en caso de error
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear tabla cliente
    $conex->exec("CREATE TABLE IF NOT EXISTS cliente (
        id_cliente SERIAL PRIMARY KEY,
        telefono VARCHAR(20),
        correo VARCHAR(100)
    )");

    // Crear tabla vehiculo
    $conex->exec("CREATE TABLE IF NOT EXISTS vehiculo (
        id_cliente INT,
        id_vehiculo SERIAL PRIMARY KEY,
        modelo VARCHAR(100),
        marca VARCHAR(100),
        color VARCHAR(50),
        FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
    )");

    // Crear tabla ingreso_vehiculo
    $conex->exec("CREATE TABLE IF NOT EXISTS ingreso_vehiculo (
        id_ingreso SERIAL PRIMARY KEY,
        id_cliente INT,
        id_vehiculo INT,
        fecha_hora TIMESTAMP,
        FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
        FOREIGN KEY (id_vehiculo) REFERENCES vehiculo(id_vehiculo)
    )");

    // Crear tabla salida_vehiculo
    $conex->exec("CREATE TABLE IF NOT EXISTS salida_vehiculo (
        id_salida SERIAL PRIMARY KEY,
        id_ingreso INT,
        id_cliente INT,
        id_vehiculo INT,
        fecha_hora TIMESTAMP,
        FOREIGN KEY (id_ingreso) REFERENCES ingreso_vehiculo(id_ingreso),
        FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
        FOREIGN KEY (id_vehiculo) REFERENCES vehiculo(id_vehiculo)
    )");

    // Crear tabla pago
    $conex->exec("CREATE TABLE IF NOT EXISTS pago (
        id_pago SERIAL PRIMARY KEY,
        id_salida INT,
        id_cliente INT,
        id_vehiculo INT,
        id_ingreso INT,
        monto DECIMAL(10,2),
        fecha_hora TIMESTAMP,
        FOREIGN KEY (id_salida) REFERENCES salida_vehiculo(id_salida),
        FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
        FOREIGN KEY (id_vehiculo) REFERENCES vehiculo(id_vehiculo),
        FOREIGN KEY (id_ingreso) REFERENCES ingreso_vehiculo(id_ingreso)
    )");

    // Crear tabla tarifa
    $conex->exec("CREATE TABLE IF NOT EXISTS tarifa (
        id_tarifa SERIAL PRIMARY KEY,
        tipo_vehiculo VARCHAR(50),
        precio DECIMAL(10,2),
        descripcion TEXT,
        tiempo VARCHAR(50)
    )");

    echo "Tablas creadas exitosamente.";

} catch (PDOException $e) {
    // Error al conectar a la base de datos
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    exit();
}

?>
