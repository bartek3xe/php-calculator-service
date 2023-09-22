<?php

namespace Service;

use App\DBAL\Type\OperatorType;
use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CalculatorServiceTest extends TestCase
{
    private CalculatorService $calculatorService;

    protected function setUp(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $this->calculatorService = new CalculatorService($logger);
    }

    public function validOperatorDataProvider(): array
    {
        return [
            [OperatorType::PLUS_OPERATOR, 3, 4, 7],
            [OperatorType::MINUS_OPERATOR, 10, 5, 5],
            [OperatorType::MULTIPLY_OPERATOR, 6, 7, 42],
            [OperatorType::DIVIDE_OPERATOR, 20, 4, 5],
        ];
    }

    public function testCalculateWithValidOperator(): void
    {
        $this->assertEquals(7, $this->calculatorService->calculate('+', 3, 4));
        $this->assertEquals(5, $this->calculatorService->calculate('-', 10, 5));
        $this->assertEquals(42, $this->calculatorService->calculate('*', 6, 7));
        $this->assertEquals(5, $this->calculatorService->calculate('/', 20, 4));
    }

    public function testCalculateWithInvalidOperator(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid operator: %');
        $this->calculatorService->calculate('%', 5, 2);
    }

    public function testCalculateDivisionByZero(): void
    {
        $message = '';
        $result  = $this->calculatorService->calculate('/', 10, 0, $message);

        $this->assertNull($result);
        $this->assertEquals('Division by zero is not allowed', $message);
    }
}
