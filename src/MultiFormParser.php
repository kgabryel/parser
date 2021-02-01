<?php

namespace Frankie\Parser;

use Ds\Map;
use Frankie\Request\ParserInterface;
use InvalidArgumentException;

class MultiFormParser implements ParserInterface
{
    protected string $data;
    protected Map $parsed;

    public function __construct(?string $data = null)
    {
        $this->data = '';
    }

    public function __clone()
    {
        $this->parsed = clone $this->parsed;
    }

    public function parse(): self
    {
        return $this;
    }

    public function get(): array
    {
        return [];
    }

    public function isCorrect(): bool
    {
        return true;
    }
}
