<?php

namespace App\Service;

use App\DBAL\Type\OperatorType;
use Psr\Log\LoggerInterface;

readonly class CalculatorService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function calculate(string $operator, int $operand1, int $operand2): ?int
    {
        $this->logger->info('Called the calculate method', [
            'operator' => $operator,
            'operand1' => $operand1,
            'operand2' => $operand2,
        ]);

        $operatorFunction = self::getOperatorFunction($operator);

        if (!in_array($operator, OperatorType::VALID_OPERATORS) || $operatorFunction === null) {
            $errorMessage = 'Invalid operator ' . $operator;
            $this->logger->error($errorMessage);

            return null;
        }

        return $operatorFunction($operand1, $operand2);
    }

    public function getOperatorFunction(string $operator): ?callable
    {
        $this->logger->info('Getting operator function for operator: ' . $operator);

        $operators = [
            OperatorType::PLUS_OPERATOR     => function($a, $b) { return $a + $b; },
            OperatorType::MINUS_OPERATOR    => function($a, $b) { return $a - $b; },
            OperatorType::MULTIPLY_OPERATOR => function($a, $b) { return $a * $b; },
            OperatorType::DIVIDE_OPERATOR   => function($a, $b) {
                if ($b != 0) {
                    return $a / $b;
                }

                return null;
            },
        ];

        return $operators[$operator] ?? null;
    }
}