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

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    protected function readXmlJsonPair(int $number, array $options = []): array
    {
        $options = array_merge(
            [
                'xmlAsString' => false,
            ],
            $options
        );

        [
            'xmlAsString' => $xmlAsString,
        ] = $options;

        if ($xmlAsString) {
            $xml = file_get_contents(__DIR__ . "/meta/xml/{$number}.xml");
        } else {
            $xml = simplexml_load_file(__DIR__ . "/meta/xml/{$number}.xml");
        }
        $json = file_get_contents(__DIR__ . "/meta/json/{$number}.json");

        return [$xml, $json];
    }
}
