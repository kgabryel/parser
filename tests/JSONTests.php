<?php

use Ds\Map;
use Frankie\Parser\JSONParser;
use PHPUnit\Framework\TestCase;

class JSONTests extends TestCase
{
    public function testNullResult()
    {
        $parser = new JSONParser();
        $parser->parse();
        $parser->get();
        $this->assertEquals(new Map(), $parser->get());
    }

    public function testNullCorrect()
    {
        $parser = new JSONParser();
        $this->assertTrue($parser->isCorrect());
    }

    public function testInvalid()
    {
        $parser = new JSONParser('["test" : 123]');
        $this->assertNotTrue($parser->isCorrect());
    }

    public function testValid()
    {
        $parser = new JSONParser('
        {
    "glossary": {
        "title": "example glossary",
		"GlossDiv": {
            "title": "S",
			"GlossList": {
                "GlossEntry": {
                    "ID": "SGML",
					"SortAs": "SGML",
					"GlossTerm": "Standard Generalized Markup Language",
					"Acronym": "SGML",
					"Abbrev": "ISO 8879:1986",
					"GlossDef": {
                        "para": "A meta-markup language, used to create markup languages such as DocBook.",
						"GlossSeeAlso": ["GML", "XML"]
                    },
					"GlossSee": "markup"
                }
            }
        }
    }
}
        ');
        $parser->parse();
        $this->assertTrue($parser->isCorrect());
    }
}
