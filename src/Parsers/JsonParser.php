<?php
namespace App\Parsers;

class JsonParser implements ParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse(string $content): array
    {
        return json_decode($content, true);
    }
}