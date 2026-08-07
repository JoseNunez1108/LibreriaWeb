<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Autor.php';

final class AutorController
{
    public function listar(string $busqueda = ''): array
    {
        $connection = Database::connect();
        $model = new Autor($connection);

        return $model->obtenerTodos(trim($busqueda));
    }
}
