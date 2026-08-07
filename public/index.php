<?php

declare(strict_types=1);

$pageTitle = 'Inicio | Librería Online';

require_once __DIR__ . '/../views/partials/header.php';
?>

<section class="hero-section rounded-4 p-5 text-center shadow-sm">
    <div class="py-5">
        <h1 class="display-4 fw-bold">
            Bienvenido a nuestra librería
        </h1>

        <p class="lead mx-auto mt-3 hero-description">
            Consulta nuestro catálogo de libros y conoce a los autores
            disponibles en nuestra plataforma.
        </p>

        <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
            <a href="libros.php" class="btn btn-primary btn-lg">
                Ver libros
            </a>

            <a href="autores.php" class="btn btn-outline-dark btn-lg">
                Ver autores
            </a>
        </div>
    </div>
</section>

<section class="row g-4 mt-4">
    <div class="col-md-4">
        <article class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <h2 class="h4">Catálogo</h2>
                <p class="text-secondary">
                    Explora todos los títulos disponibles en la librería.
                </p>
            </div>
        </article>
    </div>

    <div class="col-md-4">
        <article class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <h2 class="h4">Autores</h2>
                <p class="text-secondary">
                    Consulta los autores registrados y su información.
                </p>
            </div>
        </article>
    </div>

    <div class="col-md-4">
        <article class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <h2 class="h4">Contacto</h2>
                <p class="text-secondary">
                    Envíanos tus preguntas o comentarios.
                </p>
            </div>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/../views/partials/footer.php'; ?>
