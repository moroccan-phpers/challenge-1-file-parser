<?php

namespace App\Parsers;

class ParserFactory
{
    /**
     * @var ParserInterface[]
     */
    protected $parsers;

    /**
     * ParserFactory constructor.
     * @param ParserInterface[] $parsers
     */
    public function __construct(array $parsers)
    {
        $this->parsers = $parsers;
    }

    /**
     * @param string $extension
     * @return ParserInterface
     */
    public function getParser(string $extension): ParserInterface
    {
        return $this->parsers[$extension];
    }
}