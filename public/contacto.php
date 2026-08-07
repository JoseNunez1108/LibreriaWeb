<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/controllers/ContactoController.php';

$pageTitle = 'Contacto | Librería Online';

$nombre = '';
$correo = '';
$asunto = '';
$comentario = '';
$errores = [];
$mensajeExito = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $asunto = trim($_POST['asunto'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    try {
        $controller = new ContactoController();
        $resultado = $controller->guardar($_POST);

        if ($resultado['exito']) {
            $mensajeExito = 'Tu mensaje fue enviado correctamente.';

            $nombre = '';
            $correo = '';
            $asunto = '';
            $comentario = '';
        } else {
            $errores = $resultado['errores'];
        }
    } catch (Throwable $exception) {
        $errores[] = 'No fue posible guardar el mensaje.';
    }
}

require_once __DIR__ . '/../views/partials/header.php';
?>

<section class="mb-4">
    <h1 class="fw-bold">Contacto</h1>

    <p class="text-secondary">
        Completa el formulario para enviarnos tus preguntas o comentarios.
    </p>
</section>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <section class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">

                <?php if ($mensajeExito !== null): ?>
                    <div class="alert alert-success">
                        <?= htmlspecialchars($mensajeExito) ?>
                    </div>
                <?php endif; ?>

                <?php if ($errores !== []): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form
                    method="POST"
                    action="contacto.php"
                    id="formularioContacto"
                    novalidate
                >
                    <div class="mb-3">
                        <label for="nombre" class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            maxlength="150"
                            required
                            value="<?= htmlspecialchars($nombre) ?>"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            id="correo"
                            name="correo"
                            maxlength="150"
                            required
                            value="<?= htmlspecialchars($correo) ?>"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="asunto" class="form-label">
                            Asunto
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="asunto"
                            name="asunto"
                            maxlength="200"
                            required
                            value="<?= htmlspecialchars($asunto) ?>"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="comentario" class="form-label">
                            Comentario
                        </label>

                        <textarea
                            class="form-control"
                            id="comentario"
                            name="comentario"
                            rows="6"
                            required
                        ><?= htmlspecialchars($comentario) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">
                        Enviar mensaje
                    </button>
                </form>
            </div>
        </section>
    </div>
</div>

<?php require_once __DIR__ . '/../views/partials/footer.php'; ?>
