<?php
namespace App\Utils;

class MathUtils
{
    // Compound interest: principal * (1 + rate) ^ periods
    // rate e.g. 0.05 for 5%
    public function compoundInterest(float $principal, float $rate, int $periods): float
    {
        return $principal * pow(1 + $rate, $periods);
    }

    // Calculate net salary for Colombia (example): deduct pension 4%, salud 4%, and a simplified solidarity contribution
    // This is an illustrative calculation, not legal financial advice.
    public function calculateNetSalary(float $gross): array
    {
        $pension = $gross * 0.04; // employee
        $salud = $gross * 0.04;
        // solidarity fund (simplified): if gross > 4*SMMLV, add 1% (example). We'll use SMMLV = 1160000 COP as sample value.
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

    // Conversion: km/h to m/s
    public function kmhToMs(float $kmh): float
    {
        return $kmh * 1000 / 3600;
    }
}
