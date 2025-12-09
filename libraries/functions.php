<?php

function boot(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function dumpObjectStructure($obj){
    if(is_object($obj)){
        echo 'ESTRUCTURA OBJETO';
        $rco = new ReflectionClass($obj);
        $structure = [
            'atributos' => $rco->getProperties(),
            'metodos'   => $rco->getMethods()
        ];
        echo '<pre>'.print_r($structure,true).'</pre>';
    }else{
        echo "La variable no es un objeto";
    }
}

function dump($var){
    echo '<pre>'.print_r($var,true).'</pre>';
}

/* =========================================================
          CONEXIÓN A BD Y FUNCIONES CRUD
==========================================================*/

function getPDO(){
    static $pdo = null;

    if ($pdo === null) {
        $dsn  = 'mysql:host=localhost;dbname=crud_mysql;charset=utf8mb4';
        $user = 'crud_mysql';     //Usuario MySQL con permisos sobre la base de datos 'crud_mysql'
        $pass = 'crud_mysql';     //Contraseña del usuario MySQL

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
    }

    return $pdo;
}

//Devuelve todos los usuarios
function getAllUsers(){
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT id, nombre, email, rol FROM users ORDER BY id ASC");
    return $stmt->fetchAll();
}

//Devuelve un usuario por ID o null si no existe
function getUserById($id){
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT id, nombre, email, rol FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    return $user ?: null;
}

//Crea un usuario nuevo
function createUser($nombre, $email, $rol){
    $pdo = getPDO();
    $stmt = $pdo->prepare("INSERT INTO users (nombre, email, rol) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $email, $rol]);
    return (int)$pdo->lastInsertId();
}

//Actualiza un usuario existente
function updateUser($id, $nombre, $email, $rol){
    $pdo = getPDO();
    $stmt = $pdo->prepare("UPDATE users SET nombre = ?, email = ?, rol = ? WHERE id = ?");
    return $stmt->execute([$nombre, $email, $rol, $id]);
}
