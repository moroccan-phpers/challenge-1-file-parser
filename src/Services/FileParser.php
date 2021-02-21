<?php

namespace App\Services;

use App\Parsers\ParserFactory;

class FileParser
{
    /**
     * @var ParserFactory
     */
    protected $parserFactory;

    /**
     * FileParser constructor.
     * @param ParserFactory $parserFactory
     */
    public function __construct(ParserFactory $parserFactory)
    {
        $this->parserFactory = $parserFactory;
    }

    /**
     * Takes a file name and returns its content as an array.
     *
     * @param string $filename
     *
     * @return array
     */
    public function parseFile(string $filename): array
    {
        if (! file_exists($filename)) {
            throw new \Exception(sprintf('could not parse the file %s as it does not exist', $filename));
        }

        $extension = pathinfo($filename)['extension'];

        $parser = $this->parserFactory->getParser($extension);

        $fileContent = file_get_contents($filename);

        return $parser->parse($fileContent);
    }
}