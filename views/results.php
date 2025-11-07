<?php $view = 'results'; ?>
<div class="row">
  <div class="col-12">
    <a href="/" class="btn btn-secondary mb-3">← Volver</a>

    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Empleados - Resultados</h5>
        <?php if (!empty($empResults)): ?>
          <?php if (!empty($errors)): ?>
            <div class="alert alert-warning">
              <?php foreach ($errors as $err): ?>
                <div><?= htmlspecialchars($err) ?></div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <h6>Promedio de salarios por departamento</h6>
          <ul>
            <?php foreach ($empResults['avg_by_dept'] as $dept => $avg): ?>
              <li><?= htmlspecialchars($dept) ?>: <?= number_format($avg, 2) ?></li>
            <?php endforeach; ?>
          </ul>

          <p><strong>Departamento con salario promedio más alto:</strong> <?= htmlspecialchars($empResults['top_department']) ?></p>

          <h6>Empleados por encima del promedio de su departamento</h6>
          <ul>
            <?php foreach ($empResults['above_avg_employees'] as $e): ?>
              <li><?= htmlspecialchars($e['name']) ?> — <?= number_format($e['salary'], 2) ?> (<?= htmlspecialchars($e['department']) ?>)</li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p>No se procesaron empleados.</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Ventas - Resultados</h5>
        <?php if (!empty($salesResults)): ?>
          <p><strong>Total de ventas (registros):</strong> <?= intval($salesResults['total_sales_count']) ?></p>

          <p><strong>Cliente que más gastó:</strong>
            <?php if ($salesResults['top_client']): ?>
              <?= htmlspecialchars($salesResults['top_client']['cliente']) ?> — <?= number_format($salesResults['top_client']['gastado'], 2) ?>
            <?php endif; ?>
          </p>

          <p><strong>Producto más vendido:</strong>
            <?php if ($salesResults['top_product']): ?>
              <?= htmlspecialchars($salesResults['top_product']['producto']) ?> — <?= intval($salesResults['top_product']['cantidad']) ?> unidades
            <?php endif; ?>
          </p>
        <?php else: ?>
          <p>No se procesaron ventas.</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Ejemplos de cálculos matemáticos</h5>
        <p><strong>Interés compuesto (ejemplo):</strong> Valor final: <?= number_format($compoundExample, 2) ?></p>
        <p><strong>Salario neto (ejemplo para 2,500,000 COP):</strong></p>
        <ul>
          <li>Salario bruto: <?= number_format($netSalaryExample['gross'], 2) ?></li>
          <li>Pensión: <?= number_format($netSalaryExample['pension'], 2) ?></li>
          <li>Salud: <?= number_format($netSalaryExample['salud'], 2) ?></li>
          <li>Solidaridad: <?= number_format($netSalaryExample['solidarity'], 2) ?></li>
          <li><strong>Salario neto: <?= number_format($netSalaryExample['net'], 2) ?></strong></li>
        </ul>
      </div>
    </div>

  </div>
</div>
