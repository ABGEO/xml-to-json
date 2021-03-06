<?php

/*
 * This file is part of the abgeo/xml-to-json.
 *
 * Copyright (C) 2020 Temuri Takalandze <takalandzet@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use ABGEO\XmlToJson\FileConverter;

require __DIR__ . '/../vendor/autoload.php';

$converter = new FileConverter();

// Convert example.xml to example.json
$converter->convert(__DIR__ . '/example.xml', __DIR__ . '/example.json');
