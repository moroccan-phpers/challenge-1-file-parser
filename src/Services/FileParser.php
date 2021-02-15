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
        //Default result to return in the case of no parsing, or nonexistence of the file.
        $default_result = [];
        //Check that the file-to-parse exists.
        if(file_exists($filename))
        {
            switch ($extension)
            {
                case "json":
                    return json_decode(file_get_contents($filename), true);
                case "xml":
                    $encoded_xml = json_encode(simplexml_load_string(file_get_contents($filename)));
                    return json_decode($encoded_xml, true);
                default:
                    return $default_result;
            }
        }
        return $default_result;
    }
}