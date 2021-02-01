<?php

use Ds\Map;
use Frankie\Parser\XMLParser;
use PHPUnit\Framework\TestCase;

class XMLTests extends TestCase
{
    public function testNullResult()
    {
        $parser = new XMLParser();
        $parser->parse();
        $this->assertEquals(new Map(), $parser->get());
    }

    public function testNullCorrect()
    {
        $parser = new XMLParser();
        $this->assertTrue($parser->isCorrect());
    }

    public function testInvalid()
    {
        $parser = new XMLParser('
<?xml version="1.0" encoding="UTF-8"?>
<note>
<to>Tove</to>
<from>Jani</from> 
<heading>Reminder</pheading>
<body>Don\'t forget me this weekend!</body>
</note>
        ');
        $this->assertNotTrue($parser->isCorrect());
    }

    public function testValid()
    {
        $parser = new XMLParser("
<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<note>
<to>Tove</to>
<from>Jani</from> 
<heading>Reminder</heading>
<body>Don't forget me this weekend!</body>
</note>
");
        $this->assertTrue($parser->isCorrect());
    }
}
