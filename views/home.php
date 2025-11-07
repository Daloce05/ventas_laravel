<?php $view = 'home'; ?>
<div class="row">
  <div class="col-md-6">
    <form method="post">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Empleados</h5>
          <p class="small">Agrega empleados. Usa "Añadir fila" para insertar más registros.</p>
          <table class="table table-sm" id="employees-table">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Salario</th>
                <th>Departamento</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input name="employees[name][]" class="form-control form-control-sm" value="Ana"></td>
                <td><input name="employees[salary][]" class="form-control form-control-sm" value="2000"></td>
                <td><input name="employees[department][]" class="form-control form-control-sm" value="Ventas"></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-row">-</button></td>
              </tr>
              <tr>
                <td><input name="employees[name][]" class="form-control form-control-sm" value="Luis"></td>
                <td><input name="employees[salary][]" class="form-control form-control-sm" value="3000"></td>
                <td><input name="employees[department][]" class="form-control form-control-sm" value="Ventas"></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-row">-</button></td>
              </tr>
            </tbody>
          </table>
          <button type="button" id="add-employee" class="btn btn-sm btn-outline-primary">Añadir fila</button>
          <button type="submit" class="btn btn-primary float-end">Procesar</button>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Ventas</h5>
          <p class="small">Agrega ventas. Cada fila corresponde a una venta.</p>
          <table class="table table-sm" id="sales-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Fecha</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input name="sales[id][]" class="form-control form-control-sm" value="1"></td>
                <td><input name="sales[cliente][]" class="form-control form-control-sm" value="Juan"></td>
                <td><input name="sales[producto][]" class="form-control form-control-sm" value="Camisa"></td>
                <td><input name="sales[cantidad][]" class="form-control form-control-sm" value="2"></td>
                <td><input name="sales[precio][]" class="form-control form-control-sm" value="20000"></td>
                <td><input name="sales[fecha][]" class="form-control form-control-sm" value="2025-10-01" type="date"></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-row">-</button></td>
              </tr>
            </tbody>
          </table>
          <button type="button" id="add-sale" class="btn btn-sm btn-outline-primary">Añadir fila</button>
          <div class="mt-2"><small class="text-muted">Presiona "Procesar" para enviar empleados y ventas.</small></div>
        </div>
      </div>
    </form>
  </div>

  <div class="col-md-6">
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Uso de utilidades matemáticas</h5>
        <p>Se incluyen métodos en <code>App\Utils\MathUtils</code> como interés compuesto, cálculo de salario neto (ejemplo Colombia) y conversión km/h a m/s.</p>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Instrucciones</h5>
        <ol>
          <li>Rellena las filas de empleados y ventas.</li>
          <li>Usa "Añadir fila" para más registros o "-" para eliminar una fila.</li>
          <li>Presiona "Procesar" para ver los resultados en la siguiente pantalla.</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<script>
// Add/remove row functionality
function makeRemoveButtons(container) {
  container.querySelectorAll('.remove-row').forEach(function(btn) {
    btn.removeEventListener('click', removeRow);
    btn.addEventListener('click', removeRow);
  });
}
function removeRow(e) {
  var tr = e.target.closest('tr');
  if (tr) tr.remove();
}

document.getElementById('add-employee').addEventListener('click', function() {
  var tbody = document.querySelector('#employees-table tbody');
  var tr = document.createElement('tr');
  tr.innerHTML = '<td><input name="employees[name][]" class="form-control form-control-sm"></td>' +
                 '<td><input name="employees[salary][]" class="form-control form-control-sm"></td>' +
                 '<td><input name="employees[department][]" class="form-control form-control-sm"></td>' +
                 '<td><button type="button" class="btn btn-sm btn-danger remove-row">-</button></td>';
  tbody.appendChild(tr);
  makeRemoveButtons(tbody);
});

document.getElementById('add-sale').addEventListener('click', function() {
  var tbody = document.querySelector('#sales-table tbody');
  var tr = document.createElement('tr');
  tr.innerHTML = '<td><input name="sales[id][]" class="form-control form-control-sm"></td>' +
                 '<td><input name="sales[cliente][]" class="form-control form-control-sm"></td>' +
                 '<td><input name="sales[producto][]" class="form-control form-control-sm"></td>' +
                 '<td><input name="sales[cantidad][]" class="form-control form-control-sm" type="number" min="0"></td>' +
                 '<td><input name="sales[precio][]" class="form-control form-control-sm"></td>' +
                 '<td><input name="sales[fecha][]" class="form-control form-control-sm" type="date"></td>' +
                 '<td><button type="button" class="btn btn-sm btn-danger remove-row">-</button></td>';
  tbody.appendChild(tr);
  makeRemoveButtons(tbody);
});

// init remove buttons
makeRemoveButtons(document);
</script>
