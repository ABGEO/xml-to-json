<?php

/*
 * This file is part of the abgeo/xml-to-json.
 *
 * Copyright (C) 2020 Temuri Takalandze <takalandzet@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ABGEO\XmlToJson\Test;

use ABGEO\XmlToJson\StringConverter;

class StringConverterTest extends TestCase
{

    private $converter;

    public function setUp(): void
    {
        $this->converter = new StringConverter();
    }

    public function testConvertMethod(): void
    {
        list($originalXml, $excepted) = $this->readXmlJsonPair(5, ['xmlAsString' => true]);

        $actual = $this->converter->convert($originalXml);

        $this->assertEquals($excepted, $actual);
    }
}
