<?php

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Librería Online';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title><?= htmlspecialchars($pageTitle) ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            Librería Online
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarPrincipal"
            aria-controls="navbarPrincipal"
            aria-expanded="false"
            aria-label="Mostrar navegación"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="navbarPrincipal"
        >
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a
                        class="nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>"
                        href="index.php"
                    >
                        Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $currentPage === 'libros.php' ? 'active' : '' ?>"
                        href="libros.php"
                    >
                        Libros
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $currentPage === 'autores.php' ? 'active' : '' ?>"
                        href="autores.php"
                    >
                        Autores
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $currentPage === 'contacto.php' ? 'active' : '' ?>"
                        href="contacto.php"
                    >
                        Contacto
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-5">
