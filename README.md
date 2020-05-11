# xml-to-json

Simple way to convert XML to JSON.

[![Build Status](https://travis-ci.com/ABGEO/xml-to-json.svg?branch=1.x)](https://travis-ci.com/ABGEO/xml-to-json?branch=1.x)
[![Coverage Status](https://coveralls.io/repos/github/ABGEO/xml-to-json/badge.svg?branch=1.x)](https://coveralls.io/github/ABGEO/xml-to-json?branch=1.x)
[![GitHub release](https://img.shields.io/github/release/ABGEO/xml-to-json.svg)](https://github.com/ABGEO/xml-to-json/releases)
[![Packagist Version](https://img.shields.io/packagist/v/abgeo/xml-to-json.svg)](https://packagist.org/packages/abgeo/xml-to-json)
[![GitHub license](https://img.shields.io/github/license/ABGEO/xml-to-json.svg)](https://github.com/ABGEO/xml-to-json/blob/master/LICENSE)

## Installation

You can install this library with [Composer](https://getcomposer.org/):

- `composer require abgeo/xml-to-json`

## Usage

Include composer autoloader in your main file (Ex.: index.php)

- `require __DIR__.'/../vendor/autoload.php';`

This package gives you the ability to convert XML string/file to JSON string/file.  
For this, we have two converters:
- `ABGEO\XmlToJson\StringConverter`
- `ABGEO\XmlToJson\FileConverter`

Let's look at them in action.

### Convert XML String to JSON string

Create simple XML file:

`example.xml`
```xml
<?xml version="1.0" encoding="UTF-8"?>
<profile>
    <firstName>Temuri</firstName>
    <lastName>Takalandze</lastName>
    <active>true</active>
    <position>
        <title>Developer</title>
        <department>
            <title>IT</title>
        </department>
    </position>
</profile>
```

Create an object of class `ABGEO\XmlToJson\StringConverter` and read the content of `example.xml` into a variable:

```php
$converter = new StringConverter();
$xmlContent = file_get_contents(__DIR__ . '/example.xml');
```

Now you can convert value of `$xmlContent` variable to JSON object:

```php
$jsonContent = $converter->convert($xmlContent);
```

if you print this variable, you will get the following result:

```php
echo $jsonContent;

//{
//    "profile": {
//    "firstName": "Temuri",
//        "lastName": "Takalandze",
//        "active": "true",
//        "position": {
//        "title": "Developer",
//            "department": {
//            "title": "IT"
//            }
//        }
//    }
//}
```

### Convert XML file to JSON file

Consider that you already have the `example.xml` file described in the step above. Now let's create 
an object of `ABGEO\XmlToJson\FileConverter` class:


```php
$converter = new FileConverter();
```

Using the `convert` method of this object, you can simply convert the XML file to a JSON file:

```php
$converter->convert(__DIR__ . '/example.xml', __DIR__ . '/example.json');
```

`Convert()` takes two arguments - the path to the input and output files. 
If you do not specify an output file, by default it will be {$inputFile}.json.

Finally, the `Convert ()` method will generate a new `example.json` with the following content:

`example.json`
```json
{
    "profile": {
        "firstName": "Temuri",
        "lastName": "Takalandze",
        "active": "true",
        "position": {
            "title": "Developer",
            "department": {
                "title": "IT"
            }
        }
    }
}
```

**See full example [here](examples).**

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for details.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Authors

- [**Temuri Takalandze**](https://abgeo.dev) - *Initial work*

## License

Copyright © 2020 [Temuri Takalandze](https://abgeo.dev).  
Released under the [MIT](LICENSE) license.
