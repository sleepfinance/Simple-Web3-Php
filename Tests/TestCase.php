<?php

namespace Tests;

use SWeb3\Utils;

class TestCase extends  \PHPUnit\Framework\TestCase
{
    //
    protected static function clean($item)
    {
        return strtolower(Utils::stripZero($item));
    }
}
