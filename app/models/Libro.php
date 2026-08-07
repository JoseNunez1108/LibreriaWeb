<?php

declare(strict_types=1);

final class Libro
{
    public function __construct(
        private readonly PDO $connection
    ) {
    }

    public function obtenerTodos(): array
    {
        $sql = "
            SELECT
                t.id_titulo,
                t.titulo,
                t.tipo,
                t.precio,
                t.total_ventas,
                t.fecha_pub,
                t.notas,
                GROUP_CONCAT(
                    CONCAT(a.nombre, ' ', a.apellido)
                    ORDER BY ta.ord_au
                    SEPARATOR ', '
                ) AS autores
            FROM titulos AS t
            LEFT JOIN titulo_autor AS ta
                ON t.id_titulo = ta.id_titulo
            LEFT JOIN autores AS a
                ON ta.id_autor = a.id_autor
            GROUP BY
                t.id_titulo,
                t.titulo,
                t.tipo,
                t.precio,
                t.total_ventas,
                t.fecha_pub,
                t.notas
            ORDER BY t.titulo
        ";

        $statement = $this->connection->query($sql);

        return $statement->fetchAll();
    }
}
