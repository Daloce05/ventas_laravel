<?php
namespace App\Utils;

class MathUtils
{
    // Interés compuesto: principal * (1 + tasa) ^ periodos
    // tasa p.ej. 0.05 para 5%
    public function compoundInterest(float $principal, float $rate, int $periods): float
    {
        return $principal * pow(1 + $rate, $periods);
    }

    // Calcular salario neto para Colombia (ejemplo): descontar pensión 4%, salud 4% y una contribución de solidaridad simplificada
    // Esto es una ilustración, no un consejo financiero o legal.
    public function calculateNetSalary(float $gross): array
    {
    $pension = $gross * 0.04; // empleado
        $salud = $gross * 0.04;
    // Fondo de solidaridad (simplificado): si bruto > 4*SMMLV, añadir 1% (ejemplo). Usamos SMMLV = 1160000 COP como valor de muestra.
        $smmlv = 1160000;
        $solidarity = 0;
        if ($gross > 4 * $smmlv) {
            $solidarity = $gross * 0.01;
        }
        $totalDeductions = $pension + $salud + $solidarity;
        $net = $gross - $totalDeductions;
        return [
            'gross' => $gross,
            'pension' => $pension,
            'salud' => $salud,
            'solidarity' => $solidarity,
            'net' => $net,
        ];
    }

    // Conversión: km/h a m/s
    public function kmhToMs(float $kmh): float
    {
        return $kmh * 1000 / 3600;
    }
}
