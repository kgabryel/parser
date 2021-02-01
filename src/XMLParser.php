<?php

namespace Frankie\Parser;

use Ds\Map;
use Frankie\Request\ParserInterface;
use InvalidArgumentException;

class XMLParser implements ParserInterface
{
    protected string $data;
    protected Map $parsed;

    public function __construct(?string $data = null)
    {
        $this->parsed = new Map();
        if ($data !== null) {
            $this->data = trim($data);
        }
    }

    public function __clone()
    {
        $this->parsed = clone $this->parsed;
    }

    public function parse(): self
    {
        if ($this->data === null) {
            return $this;
        }
        if (!$this->isCorrect()) {
            throw new InvalidArgumentException("Passed data isn't correct XML.");
        }
        $xml = simplexml_load_string($this->data);
        $this->data = json_encode($xml, JSON_THROW_ON_ERROR);
        $this->parsed = new Map((array)json_decode($this->data, true, 512, JSON_THROW_ON_ERROR));
        return $this;
    }

    public function isCorrect(): bool
    {
        if ($this->data === null) {
            return true;
        }
        @$xml = simplexml_load_string($this->data);
        if ($xml) {
            return true;
        }
        return false;
    }

    public function get(): array
    {
        return $this->parsed->toArray();
    }
}
