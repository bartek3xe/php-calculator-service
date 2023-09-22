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

    /**
     * @dataProvider validOperatorDataProvider
     */
    public function testCalculateWithValidOperator($operator, $firstNumber, $secondNumber, $expectedResult)
    {
        $result = $this->calculatorService->calculate($operator, $firstNumber, $secondNumber);
        $this->assertEquals($expectedResult, $result);
    }

    public function testCalculateWithInvalidOperator()
    {
        $result = $this->calculatorService->calculate('%', 5, 2);
        $this->assertNull($result);
    }
}
