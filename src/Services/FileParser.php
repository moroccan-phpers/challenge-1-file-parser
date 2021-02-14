<?php

namespace App\Services;

class FileParser
{
    /**
     * Takes a file name and returns its content as an array.
     *
     * @param string $filename
     * @param string $extension
     * @return array
     */
    public function parseFile(string $filename, string $extension): array
    {
        if ($extension === 'json') {
            return json_decode(file_get_contents($filename), true);
        } elseif($extension === 'xml') {
            $xml = simplexml_load_string(file_get_contents($filename));
            $xmlAsJson = json_encode($xml);
            return json_decode($xmlAsJson, true);
        } else {
            return [];
        }
    }
}