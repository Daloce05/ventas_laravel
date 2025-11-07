<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Taller - Empleados y Ventas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Taller</a>
  </div>
</nav>
<div class="container">
    <?php
    // Render view
    $viewFile = __DIR__ . '/' . ($view ?? 'home') . '.php';
    if (file_exists($viewFile)) {
        include $viewFile;
    } else {
        echo '<div class="alert alert-danger">Vista no encontrada: ' . htmlspecialchars($viewFile) . '</div>';
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
