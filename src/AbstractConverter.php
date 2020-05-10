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

use SimpleXMLElement;

use function array_keys;
use function reset;
use function is_array;
use function range;
use function count;
use function trim;
use function array_merge;
use function json_encode;

/**
 * Convert XML to JSON.
 *
 * @author Temuri Takalandze <takalandzet@gmail.com>
 */
abstract class AbstractConverter
{
    /**
     * Convert content of given SimpleXMLElement to array.
     *
     * @param SimpleXMLElement $xml SimpleXMLElement to extract data from.
     *
     * @return array Array with given SimpleXMLElement data.
     */
    protected function xmlToArray(SimpleXMLElement $xml): array
    {
        $childData    = null;
        $childTagName = null;
        $plainText    = null;
        $attributes   = [];
        $tags         = [];
        $namespaces   = $xml->getDocNamespaces();

        $namespaces[''] = null;

        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $name => $attribute) {
                $attributes['-' . ($prefix ? "{$prefix}:" : '') . $name] = (string)$attribute;
            }

            if (($plainText = trim((string)$xml)) && !empty($attributes)) {
                $attributes['-text'] = $plainText;
            }

            foreach ($xml->children($namespace) as $childXml) {
                $childData = $this->xmlToArray($childXml);
                $childTagName = array_keys($childData);
                $childTagName = reset($childTagName);
                $childProperties = $childData[$childTagName];

                if ($prefix) {
                    $childTagName = "{$prefix}:{$childTagName}";
                }

                if (!isset($tags[$childTagName])) {
                    $tags[$childTagName] = $childProperties;
                } elseif (
                    is_array($tags[$childTagName])
                    && range(0, count($tags[$childTagName]) - 1) === array_keys($tags[$childTagName])
                ) {
                    $tags[$childTagName][] = $childProperties;
                } else {
                    $tags[$childTagName] = [$tags[$childTagName], $childProperties];
                }
            }
        }

        return [
            $xml->getName() => $attributes || $tags ? array_merge($attributes, $tags) : $plainText,
        ];
    }

    /**
     * Convert content of given SimpleXMLElement to JSON.
     *
     * @param SimpleXMLElement $xml SimpleXMLElement to extract data from.
     *
     * @return false|string Converted JSON or false on fail.
     */
    protected function xmlToJson(SimpleXMLElement $xml): string
    {
        return json_encode($this->xmlToArray($xml), JSON_PRETTY_PRINT);
    }
}
