<?php
namespace App\Parsers;

class XmlParser implements ParserInterface
{
    /**
     * @var ParserInterface
     */
    protected $jsonParser;

    /**
     * XmlParser constructor.
     * @param ParserInterface $jsonParser
     */
    public function __construct(ParserInterface $jsonParser)
    {
        $this->jsonParser = $jsonParser;
    }

    /**
     * {@inheritDoc}
     */
    public function parse(string $content): array
    {
        $xml = simplexml_load_string($content);
        $xmlAsJson = json_encode($xml);

        return $this->jsonParser->parse($xmlAsJson);
    }
}