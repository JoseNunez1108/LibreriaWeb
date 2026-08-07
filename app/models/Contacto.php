<?php

declare(strict_types=1);

final class Contacto
{
    public function __construct(
        private readonly PDO $connection
    ) {
    }

    public function guardar(
        string $correo,
        string $nombre,
        string $asunto,
        string $comentario
    ): bool {
        $sql = "
            INSERT INTO contacto (
                correo,
                nombre,
                asunto,
                comentario
            ) VALUES (
                :correo,
                :nombre,
                :asunto,
                :comentario
            )
        ";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            'correo' => $correo,
            'nombre' => $nombre,
            'asunto' => $asunto,
            'comentario' => $comentario,
        ]);
    }
}
