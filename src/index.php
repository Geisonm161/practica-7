<?php

declare(strict_types=1);

require_once __DIR__ . '/Database.php';

$databaseStatus = 'No se pudo verificar la conexión.';
$databaseConnected = false;

try {
    $connection = Database::connect();
    $message = $connection
        ->query('SELECT message FROM greetings ORDER BY id LIMIT 1')
        ->fetchColumn();

    $databaseStatus = is_string($message) ? $message : 'Conexión exitosa a MySQL.';
    $databaseConnected = true;
} catch (Throwable $exception) {
    // El detalle se registra en el contenedor sin exponer credenciales al navegador.
    error_log($exception->getMessage());
    http_response_code(503);
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Práctica 7</title>
    <style>
        :root {
            color-scheme: light;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        * { box-sizing: border-box; }

        body {
            align-items: center;
            background: #f1f5f9;
            color: #0f172a;
            display: flex;
            justify-content: center;
            margin: 0;
            min-height: 100vh;
            padding: 1.5rem;
        }

        main {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1rem 2.5rem rgba(15, 23, 42, 0.08);
            max-width: 34rem;
            padding: 2.5rem;
            text-align: center;
            width: 100%;
        }

        h1 { font-size: clamp(2rem, 7vw, 3.5rem); margin: 0 0 0.75rem; }
        p { color: #475569; line-height: 1.6; margin: 0; }

        .status {
            align-items: center;
            background: <?= $databaseConnected ? '#ecfdf5' : '#fef2f2' ?>;
            border-radius: 0.75rem;
            color: <?= $databaseConnected ? '#047857' : '#b91c1c' ?>;
            display: flex;
            gap: 0.625rem;
            justify-content: center;
            margin-top: 1.5rem;
            padding: 0.875rem 1rem;
        }

        .indicator {
            background: currentColor;
            border-radius: 50%;
            height: 0.625rem;
            width: 0.625rem;
        }
    </style>
</head>
<body>
    <main>
        <h1>¡Hola Mundo!</h1>
        <p>Aplicación web ejecutándose con PHP, Apache, MySQL y Docker Compose.</p>
        <div class="status" role="status">
            <span class="indicator" aria-hidden="true"></span>
            <span><?= htmlspecialchars($databaseStatus, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
    </main>
</body>
</html>
