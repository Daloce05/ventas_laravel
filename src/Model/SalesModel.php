<?php
namespace App\Model;

class SalesModel
{
    private array $ventas;

    public function __construct(array $ventas)
    {
        // Each venta expected: ['id'=>..., 'cliente'=>..., 'producto'=>..., 'cantidad'=>int, 'precio'=>float, 'fecha'=>...]
        $this->ventas = $ventas;
    }

    // a) total number of sales (count of records)
    public function totalSalesCount(): int
    {
        return count($this->ventas);
    }

    // b) client who spent the most (sum cantidad * precio)
    public function clientWhoSpentMost(): ?array
    {
        $spend = [];
        foreach ($this->ventas as $v) {
            $cliente = $v['cliente'] ?? 'Unknown';
            $cantidad = intval($v['cantidad'] ?? 0);
            $precio = floatval($v['precio'] ?? 0);
            $total = $cantidad * $precio;
            if (!isset($spend[$cliente])) $spend[$cliente] = 0;
            $spend[$cliente] += $total;
        }
        if (empty($spend)) return null;
        arsort($spend);
        $topClient = key($spend);
        return ['cliente' => $topClient, 'gastado' => $spend[$topClient]];
    }

    // c) most sold product (by total quantity)
    public function mostSoldProduct(): ?array
    {
        $qty = [];
        foreach ($this->ventas as $v) {
            $producto = $v['producto'] ?? 'Unknown';
            $cantidad = intval($v['cantidad'] ?? 0);
            if (!isset($qty[$producto])) $qty[$producto] = 0;
            $qty[$producto] += $cantidad;
        }
        if (empty($qty)) return null;
        arsort($qty);
        $top = key($qty);
        return ['producto' => $top, 'cantidad' => $qty[$top]];
    }
}
