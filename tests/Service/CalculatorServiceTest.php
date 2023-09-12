<?php

namespace Service;

use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CalculatorServiceTest extends TestCase
{
    public function testCalculateWithValidOperator()
    {
        $logger            = $this->createMock(LoggerInterface::class);
        $calculatorService = new CalculatorService($logger);

        $result = $calculatorService->calculate('+', 3, 4);
        $this->assertEquals(7, $result);

        $result = $calculatorService->calculate('-', 10, 5);
        $this->assertEquals(5, $result);

        $result = $calculatorService->calculate('*', 6, 7);
        $this->assertEquals(42, $result);

        $result = $calculatorService->calculate('/', 20, 4);
        $this->assertEquals(5, $result);
    }

    public function testCalculateWithInvalidOperator()
    {
        $logger            = $this->createMock(LoggerInterface::class);
        $calculatorService = new CalculatorService($logger);

        $result = $calculatorService->calculate('%', 5, 2);
        $this->assertNull($result);
    }
}