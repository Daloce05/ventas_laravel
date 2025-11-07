<?php
namespace App\Model;

class EmployeeModel
{
    private array $employees;

    public function __construct(array $employees)
    {
        // Expect each employee: ['name'=>..., 'salary'=>float, 'department'=>...]
        $this->employees = $employees;
    }

    public function averageSalaryByDepartment(): array
    {
        $sums = [];
        $counts = [];
        foreach ($this->employees as $e) {
            $dept = $e['department'] ?? 'Unknown';
            $salary = floatval($e['salary'] ?? 0);
            if (!isset($sums[$dept])) {
                $sums[$dept] = 0;
                $counts[$dept] = 0;
            }
            $sums[$dept] += $salary;
            $counts[$dept] += 1;
        }
        $avgs = [];
        foreach ($sums as $dept => $sum) {
            $avgs[$dept] = $sum / $counts[$dept];
        }
        return $avgs;
    }

    public function departmentWithHighestAverage(): ?string
    {
        $avgs = $this->averageSalaryByDepartment();
        if (empty($avgs)) return null;
        arsort($avgs);
        reset($avgs);
        return key($avgs);
    }

    public function employeesAboveDepartmentAverage(): array
    {
        $avgs = $this->averageSalaryByDepartment();
        $result = [];
        foreach ($this->employees as $e) {
            $dept = $e['department'] ?? 'Unknown';
            $salary = floatval($e['salary'] ?? 0);
            if (isset($avgs[$dept]) && $salary > $avgs[$dept]) {
                $result[] = $e;
            }
        }
        return $result;
    }
}
