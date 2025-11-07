<?php
namespace App\Controller;

use App\Model\EmployeeModel;
use App\Model\SalesModel;
use App\Utils\MathUtils;

class MainController
{
    public function handleGet(string $action)
    {
        if ($action === 'home') {
            $this->render('home');
            return;
        }

        $this->render('home');
    }

    public function handlePost()
    {
    // Soporta dos modos de entrada: áreas JSON (legado) o formularios dinámicos.
        $employees = [];
        $ventas = [];
        $errors = [];

    // 1) Arreglos de formulario: employees[name][], employees[salary][], employees[department][]
        if (!empty($_POST['employees']) && is_array($_POST['employees'])) {
            $e = $_POST['employees'];
            $names = $e['name'] ?? [];
            $salaries = $e['salary'] ?? [];
            $depts = $e['department'] ?? [];
            $count = max(count($names), count($salaries), count($depts));
            for ($i = 0; $i < $count; $i++) {
                $name = trim($names[$i] ?? '');
                $salary = $salaries[$i] ?? '';
                $dept = trim($depts[$i] ?? '');
                if ($name === '' && $salary === '' && $dept === '') continue;
                $salary = floatval(str_replace([',',' '], ['.',''], $salary));
                $employees[] = ['name' => $name, 'salary' => $salary, 'department' => $dept];
            }
        }

    // 2) Arreglos de formulario para ventas: sales[id][], sales[cliente][], sales[producto][], sales[cantidad][], sales[precio][], sales[fecha][]
        if (!empty($_POST['sales']) && is_array($_POST['sales'])) {
            $s = $_POST['sales'];
            $ids = $s['id'] ?? [];
            $clientes = $s['cliente'] ?? [];
            $productos = $s['producto'] ?? [];
            $cantidades = $s['cantidad'] ?? [];
            $precios = $s['precio'] ?? [];
            $fechas = $s['fecha'] ?? [];
            $count = max(count($ids), count($clientes), count($productos), count($cantidades), count($precios), count($fechas));
            for ($i = 0; $i < $count; $i++) {
                $id = trim($ids[$i] ?? '');
                $cliente = trim($clientes[$i] ?? '');
                $producto = trim($productos[$i] ?? '');
                $cantidad = intval($cantidades[$i] ?? 0);
                $precio = floatval(str_replace([',',' '], ['.',''], $precios[$i] ?? 0));
                $fecha = trim($fechas[$i] ?? '');
                if ($id === '' && $cliente === '' && $producto === '' && $cantidad === 0 && $precio == 0 && $fecha === '') continue;
                $ventas[] = ['id' => $id, 'cliente' => $cliente, 'producto' => $producto, 'cantidad' => $cantidad, 'precio' => $precio, 'fecha' => $fecha];
            }
        }

    // 3) Compatibilidad hacia atrás: parsear áreas JSON si se proporcionan
        $employeesJson = $_POST['employees_json'] ?? '';
        $salesJson = $_POST['sales_json'] ?? '';
        if (!empty($employeesJson) && empty($employees)) {
            $decoded = json_decode($employeesJson, true);
            if (is_array($decoded)) {
                $employees = $decoded;
            } else {
                $errors[] = 'JSON de empleados inválido.';
            }
        }
        if (!empty($salesJson) && empty($ventas)) {
            $decoded2 = json_decode($salesJson, true);
            if (is_array($decoded2)) {
                $ventas = $decoded2;
            } else {
                $errors[] = 'JSON de ventas inválido.';
            }
        }

    // Procesar empleados
        $empResults = [];
        if (!empty($employees)) {
            $empModel = new EmployeeModel($employees);
            $empResults['avg_by_dept'] = $empModel->averageSalaryByDepartment();
            $empResults['top_department'] = $empModel->departmentWithHighestAverage();
            $empResults['above_avg_employees'] = $empModel->employeesAboveDepartmentAverage();
        }

    // Procesar ventas
        $salesResults = [];
        if (!empty($ventas)) {
            $salesModel = new SalesModel($ventas);
            $salesResults['total_sales_count'] = $salesModel->totalSalesCount();
            $salesResults['top_client'] = $salesModel->clientWhoSpentMost();
            $salesResults['top_product'] = $salesModel->mostSoldProduct();
        }

    // Ejemplo de uso de utilidades matemáticas (interés compuesto y salario neto)
        $math = new MathUtils();
    $compoundExample = $math->compoundInterest(1000, 0.05, 12); // ejemplo
    $netSalaryExample = $math->calculateNetSalary(2500000); // ejemplo COP

        $this->render('results', [
            'employees' => $employees,
            'empResults' => $empResults,
            'ventas' => $ventas,
            'salesResults' => $salesResults,
            'compoundExample' => $compoundExample,
            'netSalaryExample' => $netSalaryExample,
        ]);
    }

    private function render(string $view, array $data = [])
    {
        extract($data);
        include __DIR__ . '/../../views/layout.php';
    }
}
