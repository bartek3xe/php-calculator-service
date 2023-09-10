<?php

namespace App\Service;

use App\DBAL\Type\OperatorType;

class Calculator
{
    public static function calculate(string $operator, $operand1, $operand2): int
    {
        $operatorFunction = self::getOperatorFunction($operator);

        if ($operatorFunction === null) {
            throw new \InvalidArgumentException('Invalid operator');
        }

        return $operatorFunction($operand1, $operand2);
    }

    public static function getOperatorFunction(string $operator): ?callable
    {
        $operators = [
            OperatorType::PLUS_OPERATOR     => function($a, $b) { return $a + $b; },
            OperatorType::MINUS_OPERATOR    => function($a, $b) { return $a - $b; },
            OperatorType::MULTIPLY_OPERATOR => function($a, $b) { return $a * $b; },
            OperatorType::DIVIDE_OPERATOR   => function($a, $b) {
                if ($b != 0) {
                    return $a / $b;
                }

                throw new \Error('Division by zero is not allowed.');
            },
        ];

        return $operators[$operator] ?? null;
    }
}