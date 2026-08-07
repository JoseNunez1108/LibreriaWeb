<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/controllers/LibroController.php';

$pageTitle = 'Libros | Librería Online';
$error = null;
$libros = [];

try {
    $controller = new LibroController();
    $libros = $controller->listar();
} catch (Throwable $exception) {
    $error = 'No fue posible cargar el listado de libros.';
}

require_once __DIR__ . '/../views/partials/header.php';
?>

<section class="mb-4">
    <h1 class="fw-bold">Libros disponibles</h1>

    <p class="text-secondary">
        Consulta el catálogo completo de nuestra librería.
    </p>
</section>

<?php if ($error !== null): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php elseif ($libros === []): ?>
    <div class="alert alert-info">
        No hay libros disponibles.
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($libros as $libro): ?>
            <div class="col-md-6 col-lg-4">
                <article class="card h-100 border-0 shadow-sm book-card">
                    <div class="card-body d-flex flex-column">
                        <span class="badge text-bg-primary align-self-start mb-3">
                            <?= htmlspecialchars($libro['tipo']) ?>
                        </span>

                        <h2 class="h5 fw-bold">
                            <?= htmlspecialchars($libro['titulo']) ?>
                        </h2>

                        <p class="text-secondary mb-2">
                            <strong>Autor:</strong>
                            <?= htmlspecialchars(
                                $libro['autores'] ?? 'Autor no disponible'
                            ) ?>
                        </p>

                        <p class="small text-secondary flex-grow-1">
                            <?= htmlspecialchars($libro['notas']) ?>
                        </p>

                        <div class="border-top pt-3 mt-3">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold text-success">
                                    <?php if ($libro['precio'] !== null): ?>
                                        $<?= number_format(
                                            (float) $libro['precio'],
                                            2
                                        ) ?>
                                    <?php else: ?>
                                        Precio no disponible
                                    <?php endif; ?>
                                </span>

                                <span class="text-secondary small">
                                    Ventas:
                                    <?= (int) ($libro['total_ventas'] ?? 0) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../views/partials/footer.php'; ?>
