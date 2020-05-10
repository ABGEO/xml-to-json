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

use function simplexml_load_string;

/**
 * Convert XML string to JSON string.
 *
 * @author Temuri Takalandze <takalandzet@gmail.com>
 */
class StringConverter extends AbstractConverter
{
    /**
     * Convert XML string to JSON string.
     *
     * @param string $xmlContent XML Content.
     *
     * @return false|string Converted JSON or false on fail.
     */
    public function convert(string $xmlContent): string
    {
        $xmlNode = simplexml_load_string($xmlContent);

        return $this->xmlToJson($xmlNode);
    }
}
