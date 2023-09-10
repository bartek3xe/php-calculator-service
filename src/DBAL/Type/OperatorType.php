<?php

namespace App\DBAL\Type;

enum OperatorType
{
    const PLUS_OPERATOR     = '+';
    const MINUS_OPERATOR    = '-';
    const MULTIPLY_OPERATOR = '*';
    const DIVIDE_OPERATOR   = '/';
    const MODULO_OPERATOR   = '%';
    const POWER_OPERATOR    = '**';

    const VALID_OPERATORS = [
        self::PLUS_OPERATOR     => self::PLUS_OPERATOR,
        self::MINUS_OPERATOR    => self::MINUS_OPERATOR,
        self::MULTIPLY_OPERATOR => self::MULTIPLY_OPERATOR,
        self::DIVIDE_OPERATOR   => self::DIVIDE_OPERATOR,
        self::MODULO_OPERATOR   => self::MODULO_OPERATOR,
        self::POWER_OPERATOR    => self::POWER_OPERATOR,
    ];
}