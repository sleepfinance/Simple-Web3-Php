<?php

namespace Tests\Fixtures;

use phpseclib\Math\BigInteger;
use Tests\TestCase;

class NumberFixture extends TestCase
{
    public static function validNumberEncoderData()
    {
        return [
            [
                'uint8',
                1,
                '0000000000000000000000000000000000000000000000000000000000000001',
            ],
            [
                'uint8',
                '8',
                '0000000000000000000000000000000000000000000000000000000000000008',
            ],
            [
                'int8',
                -1,
                'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff',
            ],
            [
                'int8',
                -122,
                'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff86',
            ],
            [
                'int8',
                -128,
                'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff80',
            ],

            [
                'int',
                -122,
                'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff86',
            ],
            [
                'int',
                new BigInteger(122),
                '000000000000000000000000000000000000000000000000000000000000007a',
            ],
            [
                'int32',
                new BigInteger(-122),
                'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff86',
            ],
            [
                'int32',
                -0xa2,
                'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff5e',
            ],
            [
                'uint24',
                12312312,
                '0000000000000000000000000000000000000000000000000000000000bbdef8',
            ],
            [
                'int24',
                -123123,
                'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe1f0d',
            ],
        ];
    }

    public static function invalidNumberEncoderData()
    {
        return  [
            ['uint8', 'blem'],
            ['uint8', '--123'],
            ['uint8', '256'],
            ['int8', '128'],
            ['int8', '-129'],
            ['int17', '129'],
        ];
    }

    public static function validNumberDecoderData()
    {
        return [
            [
                'uint8',
                '0x0000000000000000000000000000000000000000000000000000000000000012',
                18,
                '0x',
            ],
            [
                'uint256',
                '0x00000000000000000000003f29a33f562a1feab357509b77f71717e78667e7c1',
                '92312312312312312312312312312312312303939393939393',
                '0x',
            ],
            [
                'int256',
                '0xffffffffffffffffffffffc0d65cc0a9d5e0154ca8af648808e8e8187998183f',
                '-92312312312312312312312312312312312303939393939393',
                '0x',
            ],
            [
                'int8',
                '0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe7',
                '-25',
                '0x',
            ],
            [
                'uint256',
                '0x000000000000000000000000000000000000000000000000000000000001e0f30000000000000000000000000000000000000000000000000000000000000001',
                new BigInteger(123123),
                '0x0000000000000000000000000000000000000000000000000000000000000001',
            ],
            [
                'uint24',
                '0x0000000000000000000000000000000000000000000000000000000000bbdef8',
                new BigInteger(12312312),
                '0x',
            ],
            [
                'int24',
                '0xfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe1f0d',
                new BigInteger(-123123),
                '0x',
            ],
        ];
    }

    public static function invalidNumberDecoderData()
    {
        return [
            ['uint8', '0x'],
            [
                'uint8',
                '0x00000000000000000000003f29a33f562a1feab357509b77f71717e78667e7c1',
            ],
            [
                'int17',
                '0xffffffffffffffffffffffc0d65cc0a9d5e0154ca8af648808e8e8187998183f',
            ],
        ];
    }
}
