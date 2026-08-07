<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/controllers/AutorController.php';

$pageTitle = 'Autores | Librería Online';
$busqueda = trim($_GET['buscar'] ?? '');
$autores = [];
$error = null;

try {
    $controller = new AutorController();
    $autores = $controller->listar($busqueda);
} catch (Throwable $exception) {
    $error = 'No fue posible cargar el listado de autores.';
}

require_once __DIR__ . '/../views/partials/header.php';
?>

<section class="mb-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <h1 class="fw-bold">Nuestros autores</h1>

            <p class="text-secondary mb-0">
                Consulta los autores disponibles y la cantidad de libros
                asociados a cada uno.
            </p>
        </div>

        <span class="badge rounded-pill text-bg-dark fs-6">
            <?= count($autores) ?> autores
        </span>
    </div>
</section>

<section class="card border-0 shadow-sm mb-5">
    <div class="card-body p-4">
        <form method="GET" action="autores.php" class="row g-3">
            <div class="col-md-9">
                <label for="buscar" class="form-label fw-semibold">
                    Buscar autor
                </label>

                <input
                    type="search"
                    class="form-control form-control-lg"
                    id="buscar"
                    name="buscar"
                    placeholder="Nombre, apellido, ciudad o país"
                    value="<?= htmlspecialchars($busqueda) ?>"
                >
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    Buscar
                </button>

                <?php if ($busqueda !== ''): ?>
                    <a
                        href="autores.php"
                        class="btn btn-outline-secondary btn-lg"
                        title="Limpiar búsqueda"
                    >
                        Limpiar
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</section>

<?php if ($error !== null): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php elseif ($autores === []): ?>
    <div class="alert alert-info">
        No se encontraron autores con el criterio indicado.
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($autores as $autor): ?>
            <div class="col-md-6 col-lg-4">
                <article class="card h-100 border-0 shadow-sm author-card">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="author-avatar mb-3">
                            <?= htmlspecialchars(
                                strtoupper(
                                    substr($autor['nombre'], 0, 1) .
                                    substr($autor['apellido'], 0, 1)
                                )
                            ) ?>
                        </div>

                        <h2 class="h4 fw-bold mb-1">
                            <?= htmlspecialchars(
                                $autor['nombre'] . ' ' . $autor['apellido']
                            ) ?>
                        </h2>

                        <p class="text-secondary mb-3">
                            <?= htmlspecialchars($autor['ciudad']) ?>,
                            <?= htmlspecialchars($autor['pais']) ?>
                        </p>

                        <dl class="row small mb-4">
                            <dt class="col-4">Teléfono</dt>
                            <dd class="col-8">
                                <?= htmlspecialchars($autor['telefono']) ?>
                            </dd>

                            <dt class="col-4">Estado</dt>
                            <dd class="col-8">
                                <?= htmlspecialchars($autor['estado']) ?>
                            </dd>

                            <dt class="col-4">Código postal</dt>
                            <dd class="col-8">
                                <?= htmlspecialchars(
                                    (string) $autor['cod_postal']
                                ) ?>
                            </dd>
                        </dl>

                        <div class="mt-auto pt-3 border-top">
                            <span class="badge text-bg-warning text-dark">
                                <?= (int) $autor['total_libros'] ?>
                                libro<?= (int) $autor['total_libros'] === 1 ? '' : 's' ?>
                            </span>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../views/partials/footer.php'; ?>
