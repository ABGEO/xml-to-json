<?php

/*
 * This file is part of the abgeo/xml-to-json.
 *
 * Copyright (C) 2020 Temuri Takalandze <takalandzet@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ABGEO\XmlToJson;

use InvalidArgumentException;

use function is_readable;
use function fopen;
use function simplexml_load_file;
use function fwrite;
use function fclose;

/**
 * Convert XML file to JSON file.
 *
 * @author Temuri Takalandze <takalandzet@gmail.com>
 */
class FileConverter extends AbstractConverter
{
    /**
     * Convert XML file to JSON file.
     *
     * @param string $inputFile  Input XML file path.
     * @param string $outputFile Output JSON file path.
     * If null, filename will be {$inputFile}.json
     */
    public function convert(string $inputFile, ?string $outputFile = null)
    {
        $xmlNode      = null;
        $outputHandle = null;

        if (!$outputFile) {
            $outputFile = "{$inputFile}.json";
        }

        if (!is_readable($inputFile)) {
            throw new InvalidArgumentException("File '{$inputFile}' not found or is not readable!");
        }

        if (!$outputHandle = fopen($outputFile, 'w')) {
            throw new InvalidArgumentException("Can not open '{$inputFile}' to write!");
        }

        $xmlNode = simplexml_load_file($inputFile);

        fwrite($outputHandle, $this->xmlToJson($xmlNode));
        fclose($outputHandle);
    }
}
