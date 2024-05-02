<?php
// User.php

require_once 'Database.php';

class User extends Database {
    public function registrarusuario($nombre, $apellido, $usuario, $correo, $contrasena) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, apellido, usuario, correo, contrasenia) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $apellido, $usuario, $correo, $contrasena]);
            return true;
        } catch(PDOException $e) {
            echo 'Error al registrar usuario: ' . $e->getMessage();
            return false;
        }
    }

    public function validarusuario($usuario){
        try {
            $stmt = $this->pdo->prepare("SELECT usuario FROM usuarios WHERE usuario = ?");
            $stmt->execute([$usuario]);
            $existingUser = $stmt->fetch();
            return $existingUser ? true : false;
        } catch(PDOException $e) {
            echo 'Error al verificar usuario existente: ' . $e->getMessage();
            return false;
        }
    }

    public function loginUser($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}

?>