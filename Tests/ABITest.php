<?php

namespace Tests;

use SWeb3\ABI;
use Tests\Fixtures\AddressFixture;
use Tests\Fixtures\ArrayFixture;
use Tests\TestCase;
use Tests\Fixtures\BoolFixture;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Tests\Fixtures\BytesFixture;
use Tests\Fixtures\NumberFixture;
use Tests\Fixtures\StringFixture;
use Tests\Fixtures\TupleFixture;

/**
 * @coversDefaultClass \SleepFinance\Encoder
 */
class ABITest extends TestCase
{
    /**
     * @covers ::EncodeParameter_External
     */
    #[DataProviderExternal(AddressFixture::class, 'validAddressEncoderData')]
    public function testCanCorrectlyEncodeAddress($value, $expected): void
    {
        $result = ABI::EncodeParameter_External('address', $value);
        $this->assertSame(static::clean($result), static::clean($expected));
    }
    /**
     * @covers::EncodeParameter_External
     */
    #[DataProviderExternal(AddressFixture::class, 'invalidAddressEncoderData')]
    public function testShouldFailToEncodeIncorrectAddress($value): void
    {
        $this->expectException(\Exception::class);
        ABI::EncodeParameter_External('address', $value);
    }
    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(AddressFixture::class, 'validAddressDecoderData')]
    public function testCanCorrectlyDecodeAddress($bytes, $result): void
    {
        $expected = ABI::DecodeParameter_External('address', $bytes);
        $this->assertSame(static::clean($result), static::clean($expected));
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(AddressFixture::class, 'invalidAddressDecoderData')]
    public function testWillThrowExceptionOnIncorrectAddressBytes($bytes): void
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External('address', $bytes);
    }

    /**
     * @covers ::EncodeParameter_External
     */
    #[DataProviderExternal(ArrayFixture::class, 'validArrayEncoderData')]
    public function testCanEncodeArrays($type, $values, $dynamic, $result)
    {
        $expected = ABI::EncodeParameter_External($type, $values);
        $this->assertSame(static::clean($result), static::clean($expected));
    }

    #[DataProviderExternal(ArrayFixture::class, 'invalidArrayEncoderData')]
    public function testWillThrowOnEncodeInvalidArrayData($type, $values)
    {
        $this->expectException(\Exception::class);
        ABI::EncodeParameter_External($type, $values);
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(ArrayFixture::class, 'validArrayDecoderData')]
    public function testCanDecodeArrays($type, $result, $bytes, $remaining)
    {
        if (is_array($bytes)) var_dump($type, $bytes);
        $expected = ABI::DecodeParameter_External($type, $bytes);
        $this->assertSame($result, $expected);
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(ArrayFixture::class, 'invalidArrayDecoderData')]
    public function testWillThrowOnDecodeInvalidArrayData($type, $bytes)
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External($type, $bytes);
    }

    /**
     * @covers ::EncodeParameter_External
     */
    ##BOOL
    #[DataProviderExternal(BoolFixture::class, 'validBoolEncoderData')]
    public function testCanEncodeBool($value, $expected)
    {
        $result = ABI::EncodeParameter_External('boolean', $value);
        $this->assertSame(static::clean($result), static::clean($expected));
    }

    /**
     * @covers ::EncodeParameter_External
     */
    ##BOOL
    #[DataProviderExternal(BoolFixture::class, 'invalidBoolEncoderData')]
    public function testWillThroeOnEncodeInvalidBoolean($value)
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External('boolean', $value);
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(BoolFixture::class, 'validBoolDecoderData')]
    public function testCanDecodeBoolean($bytes, $result, $remaining)
    {
        $expected = ABI::DecodeParameter_External('boolean', $bytes);
        $this->assertSame($result, $expected);
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(BoolFixture::class, 'invalidBoolDecoderData')]
    public function testWillThrowOnDecodeInvalidBoolData($bytes)
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External('boolean', $bytes);
    }



    ## BYTES


    /**
     * @covers ::EncodeParameter_External
     */
    #[DataProviderExternal(BytesFixture::class, 'validBytesEncoderData')]
    public function testCanEncodeBytes($type, $value, $expected)
    {
        $result = ABI::EncodeParameter_External($type, $value);
        $this->assertSame(static::clean($result), static::clean($expected));
    }

    /**
     * @covers ::EncodeParameter_External
     */
    #[DataProviderExternal(BytesFixture::class, 'invalidBytesEncoderData')]
    public function testWillThroeOnEncodeInvalidBytes($type,  $value)
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External($type, $value);
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(BytesFixture::class, 'validBytesDecoderData')]
    public function testCanDecodeBytes($type, $value, $expected, $remaining)
    {
        $result = ABI::DecodeParameter_External($type, $value);
        $this->assertSame(static::clean($result), static::clean($expected));
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(BytesFixture::class, 'invalidBytesDecoderData')]
    public function testWillThrowOnDecodeInvalidBytesData($type, $value)
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External($type, $value);
    }


    ## NUMBER


    /**
     * @covers ::EncodeParameter_External
     */
    #[DataProviderExternal(NumberFixture::class, 'validNumberEncoderData')]
    public function testCanEncodeNumber($type, $value, $expected)
    {
        $result = ABI::EncodeParameter_External($type, $value);
        $this->assertSame(static::clean($result), static::clean($expected));
    }

    /**
     * @covers ::EncodeParameter_External
     */
    #[DataProviderExternal(NumberFixture::class, 'invalidNumberEncoderData')]
    public function testWillThroeOnEncodeInvalidNumber($type,  $value)
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External($type, $value);
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(NumberFixture::class, 'validNumberDecoderData')]
    public function testCanDecodeNumber($param, $bytes, $result, $remaining)
    {
        $resultNumber = ABI::DecodeParameter_External($param, $bytes);
        $this->assertSame(static::clean($result), static::clean($resultNumber));
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(NumberFixture::class, 'invalidNumberDecoderData')]
    public function testWillThrowOnDecodeInvalidNumberData($type, $value)
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External($type, $value);
    }


    ## STRING


    /**
     * @covers ::EncodeParameter_External
     */
    #[DataProviderExternal(StringFixture::class, 'validStringEncoderData')]
    public function testCanEncodeString($value, $expected)
    {
        $result = ABI::EncodeParameter_External('string', $value);
        $this->assertSame(static::clean($result), static::clean($expected));
    }

    /**
     * @covers ::EncodeParameter_External
     */
    #[DataProviderExternal(StringFixture::class, 'invalidStringEncoderData')]
    public function testWillThroeOnEncodeInvalidString($value)
    {
        $this->expectException(\Exception::class);
        ABI::DecodeParameter_External('string', $value);
    }

    /**
     * @covers ::DecodeParameter_External
     */
    #[DataProviderExternal(StringFixture::class, 'validStringDecoderData')]
    public function testCanDecodeString($value, $expected, $remaining)
    {
        $result = ABI::DecodeParameter_External('string', $value);
        $this->assertSame($expected, $result);
    }

    ## TUPLE


    /**
     * @covers ::EncodeGroup
     */
    #[DataProviderExternal(TupleFixture::class, 'validEncoderData')]
    public function testCanEncodeTuple($components, $values, $dynamic, $result)
    {
        $expected = ABI::EncodeGroup(json_decode(json_encode($components)), $values);
        $this->assertSame($result, $expected);
    }



    /**
     * @covers ::DecodeGroup
     */
    #[DataProviderExternal(TupleFixture::class, 'validDecoderData')]
    public function testCanDecodeTuple($components, $result, $bytes, $remaining)
    {
        $expected = ABI::DecodeGroup(json_decode(json_encode($components)), $bytes, 0);
        $this->assertSame($expected, $result);
    }
}
