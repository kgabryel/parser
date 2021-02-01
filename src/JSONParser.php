<?php

namespace Frankie\Parser;

use Ds\Map;
use Frankie\Request\ParserInterface;
use InvalidArgumentException;

class JSONParser implements ParserInterface
{
    protected string $data;
    protected Map $parsed;

    public function __construct(?string $data = null)
    {
        if ($data === null) {
            $data = '{}';
        }
        $this->parsed = new Map();
        $this->data = trim($data);
    }

    public function __clone()
    {
        $this->parsed = clone $this->parsed;
    }

    public function parse(): self
    {
        $tmp = (array)json_decode($this->data, true, 512, JSON_THROW_ON_ERROR);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException("Passed data isn't correct JSON.");
        }
        $this->parsed = new Map($tmp);
        return $this;
    }

    public function get(): array
    {
        return $this->parsed->toArray();
    }

    public function isCorrect(): bool
    {
        json_decode($this->data, true, 512, JSON_THROW_ON_ERROR);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
