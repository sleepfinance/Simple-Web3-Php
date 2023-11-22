<?php

namespace Tests\Fixtures;

use Tests\TestCase;

class AddressFixture extends TestCase
{
    public static function validAddressEncoderData(): array
    {
        return [
            [
                '00000000219ab540356cbb839cbe05303d7705fa',
                '00000000000000000000000000000000219ab540356cbb839cbe05303d7705fa',
            ],
            [
                '0xc02aaa39b223fe8d0a0e5c4f27ead9083c756cC2',
                '000000000000000000000000c02aaa39b223fe8d0a0e5c4f27ead9083c756cc2',
            ]
        ];
    }
    public static function invalidAddressEncoderData(): array
    {
        return
            [
                ['blem'],
                ['--123'],
                ['2'],
                ['-1'],
                ['0x01'],
                ['0x00'],
                [123],
            ];
    }

    public static function validAddressDecoderData(): array
    {
        return
            [
                [
                    'bytes' => '0x000000000000000000000000e6004226bc1f1ba37e5c2c4689693b94b863cd58',
                    'result' => '0xe6004226BC1F1ba37E5C2c4689693b94B863cd58',
                    'remaining' => '0x',
                ], [
                    'bytes' => '0x000000000000000000000000e6004226bc1f1ba37e5c2c4689693b94b863cd580000000000000000000000000000000000000000000000000000000000000001',
                    'result' => '0xe6004226BC1F1ba37E5C2c4689693b94B863cd58',
                    'remaining' => '0x0000000000000000000000000000000000000000000000000000000000000001',
                ]
            ];
    }

    public static function invalidAddressDecoderData(): array
    {
        return
            [
                ['0x00000000000000000000e6004226bc1f1ba37e5c2c4689693b94b863cd58'],
            ];
    }
}
