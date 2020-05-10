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

use ABGEO\XmlToJson\AbstractConverter;
use SimpleXMLElement;

class AbstractConverterTest extends TestCase
{
    private $converter;

    public function setUp(): void
    {
        $this->converter = new class extends AbstractConverter {
            public function xmlToArrayPublic(SimpleXMLElement $xml)
            {
                return parent::xmlToArray($xml);
            }

            public function xmlToJsonPublic(SimpleXMLElement $xml)
            {
                return parent::xmlToJson($xml);
            }
        };
    }

    public function testXmlToArrayMethodWithSimpleData(): void
    {
        $this->doTestWithData(1);
    }

    public function testXmlToArrayMethodWithNamespacePrefixes(): void
    {
        $this->doTestWithData(2);
    }

    public function testXmlToArrayMethodWithKeyAttributes(): void
    {
        $this->doTestWithData(3);
    }

    public function testXmlToArrayMethodWithArrays(): void
    {
        $this->doTestWithData(4);
    }

    public function testXmlToArrayMethodWithNestedData(): void
    {
        $this->doTestWithData(5);
    }

    public function testXmlToJsonMethod(): void
    {
        list($originalXml, $excepted) = $this->readXmlJsonPair(5);
        $actual = $this->converter->xmlToJsonPublic($originalXml);

        $this->assertEquals($excepted, $actual);
    }

    private function doTestWithData(int $testNumber)
    {
        list($originalXml, $excepted) = $this->readXmlJsonPair($testNumber);

        $actual = $this->converter->xmlToArrayPublic($originalXml);
        $excepted = json_decode($excepted, true);

        $this->assertEquals($excepted, $actual);
    }
}
