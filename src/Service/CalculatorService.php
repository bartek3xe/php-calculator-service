<?php

namespace App\Service;

use App\DBAL\Type\OperatorType;
use Psr\Log\LoggerInterface;

readonly class CalculatorService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function calculate(string $operator, int $firstNumber, int $secondNumber, &$message = ''): ?int
    {
        $this->validateOperator($operator);

        $this->logger->info('Called the calculate method properly', [
            'operator' => $operator,
            'operand1' => $firstNumber,
            'operand2' => $secondNumber,
        ]);

        if ($operator === OperatorType::DIVIDE_OPERATOR && (!$firstNumber || !$secondNumber)) {
            $message = 'Division by zero is not allowed';
            $this->logger->info($message);

            return null;
        }

        return match ($operator) {
            OperatorType::PLUS_OPERATOR     => $this->add($firstNumber, $secondNumber),
            OperatorType::MINUS_OPERATOR    => $this->deduct($firstNumber, $secondNumber),
            OperatorType::DIVIDE_OPERATOR   => $this->divide($firstNumber, $secondNumber),
            OperatorType::MULTIPLY_OPERATOR => $this->multiply($firstNumber, $secondNumber),
        };
    }

    private function add(int $firstNumber, int $secondNumber): int
    {
        return $firstNumber + $secondNumber;
    }

    private function deduct(int $firstNumber, int $secondNumber): int
    {
        return $firstNumber - $secondNumber;
    }

    private function divide(int $firstNumber, int $secondNumber): int
    {
        return $firstNumber / $secondNumber;
    }

    private function multiply(int $firstNumber, int $secondNumber): int
    {
        return $firstNumber * $secondNumber;
    }

    private function validateOperator(string $operator): void
    {
        if (!in_array($operator, [
            OperatorType::PLUS_OPERATOR,
            OperatorType::MINUS_OPERATOR,
            OperatorType::DIVIDE_OPERATOR,
            OperatorType::MULTIPLY_OPERATOR,
        ])) {
            $this->logger->info('Invalid operator ' . $operator);
            throw new \InvalidArgumentException('Invalid operator: ' . $operator);
        }
    }
}
