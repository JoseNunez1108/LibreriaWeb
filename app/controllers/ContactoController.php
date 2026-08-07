<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Contacto.php';

final class ContactoController
{
    public function guardar(array $datos): array
    {
        $correo = trim($datos['correo'] ?? '');
        $nombre = trim($datos['nombre'] ?? '');
        $asunto = trim($datos['asunto'] ?? '');
        $comentario = trim($datos['comentario'] ?? '');

        $errores = [];

        if ($nombre === '') {
            $errores[] = 'El nombre es obligatorio.';
        }

        if ($correo === '') {
            $errores[] = 'El correo es obligatorio.';
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El correo no tiene un formato válido.';
        }

        if ($asunto === '') {
            $errores[] = 'El asunto es obligatorio.';
        }

        if ($comentario === '') {
            $errores[] = 'El comentario es obligatorio.';
        }

        if ($errores !== []) {
            return [
                'exito' => false,
                'errores' => $errores,
            ];
        }

        $connection = Database::connect();
        $model = new Contacto($connection);

        $guardado = $model->guardar(
            $correo,
            $nombre,
            $asunto,
            $comentario
        );

        return [
            'exito' => $guardado,
            'errores' => [],
        ];
    }
}
