<?php

namespace App\Parsers;

interface ParserInterface
{
    /**
     * Parses the passed content and returns it as php array
     * @param string $content
     *
     * @return array
     */
    public function parse(string $content): array;
}