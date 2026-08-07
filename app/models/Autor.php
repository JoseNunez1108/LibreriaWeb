<?php

declare(strict_types=1);

final class Autor
{
    public function __construct(
        private readonly PDO $connection
    ) {
    }

    public function obtenerTodos(string $busqueda = ''): array
    {
        $sql = "
            SELECT
                a.id_autor,
                a.nombre,
                a.apellido,
                a.telefono,
                a.direccion,
                a.ciudad,
                a.estado,
                a.pais,
                a.cod_postal,
                COUNT(DISTINCT ta.id_titulo) AS total_libros
            FROM autores AS a
            LEFT JOIN titulo_autor AS ta
                ON a.id_autor = ta.id_autor
        ";

        $parametros = [];

        if ($busqueda !== '') {
            $sql .= "
                WHERE
                    CONCAT(a.nombre, ' ', a.apellido) LIKE :busqueda_nombre
                    OR a.nombre LIKE :busqueda_nombre_simple
                    OR a.apellido LIKE :busqueda_apellido
                    OR a.ciudad LIKE :busqueda_ciudad
                    OR a.pais LIKE :busqueda_pais
            ";

            $valorBusqueda = '%' . $busqueda . '%';

            $parametros = [
                'busqueda_nombre' => $valorBusqueda,
                'busqueda_nombre_simple' => $valorBusqueda,
                'busqueda_apellido' => $valorBusqueda,
                'busqueda_ciudad' => $valorBusqueda,
                'busqueda_pais' => $valorBusqueda,
            ];
        }

        $sql .= "
            GROUP BY
                a.id_autor,
                a.nombre,
                a.apellido,
                a.telefono,
                a.direccion,
                a.ciudad,
                a.estado,
                a.pais,
                a.cod_postal
            ORDER BY
                a.apellido,
                a.nombre
        ";

        $statement = $this->connection->prepare($sql);
        $statement->execute($parametros);

        return $statement->fetchAll();
    }
}
