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

use ABGEO\XmlToJson\FileConverter;

class FileConverterTest extends TestCase
{

    private $converter;

    public function setUp(): void
    {
        $this->converter = new FileConverter();
    }

    public function testConvertMethodWithInputFileNotFoundException(): void
    {
        $this->expectExceptionMessage('File \'invalid.xml\' not found or is not readable!');
        $this->converter->convert('invalid.xml');
    }

    public function testConvertMethodWithCannotCreateOutputFileException(): void
    {
        $this->expectExceptionMessage(
            'Can not open \'' . __DIR__ . '/meta/xml/1.xml\' to write!'
        );
        $this->converter->convert(__DIR__ . '/meta/xml/1.xml', '/bla/bla/invalid.json');
    }

    public function testConvertMethodSuccess(): void
    {
        $this->converter->convert(__DIR__ . '/meta/xml/5.xml', __DIR__ . '/meta/json/5.new.json');
        $this->assertFileExists(__DIR__ . '/meta/json/5.new.json');
        $this->assertFileEquals(__DIR__ . '/meta/json/5.json', __DIR__ . '/meta/json/5.new.json');
    }
}
