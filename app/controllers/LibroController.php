<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Libro.php';

final class LibroController
{
    public function listar(): array
    {
        $connection = Database::connect();
        $model = new Libro($connection);

        return $model->obtenerTodos();
    }
}
