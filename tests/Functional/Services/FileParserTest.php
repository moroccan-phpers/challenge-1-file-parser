<?php

namespace Tests\Functional\Services;

use App\DependencyInjection\Container;
use PHPUnit\Framework\TestCase;

class FileParserTest extends TestCase
{
    /**
     * @var string
     */
    protected $fixturesPath;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->fixturesPath = __DIR__ . '/../../Fixtures/Files/';
    }

    /**
     * @test
     */
    public function itParsesAJsonFile()
    {
        $jsonFile = $this->fixturesPath . 'file.json';

        $fileParser = Container::getContainer()->get('app.services.file_parser');

        $parsedFile = $fileParser->parseFile($jsonFile);

        $expectedContent = [
            'name' => 'moroccan-phpers/challenge-1',
            'description' => 'PHP Challenge by the moroccan-phpers community',
            'type' => 'project',
            'license' => 'MIT',
            'authors' => [
                [
                    'name' => 'Anass Rakibi',
                    'email' => 'anass.rakibi@gmail.com',
                ]
            ],
            'require' => [
                'php' => '>=7.3',
            ],
            'require-dev' => [
                'phpunit/phpunit' => '9.4.3',
            ],
            'autoload' => [
                'psr-4' => [
                    'App\\' => 'src/',
                ]
            ],
            'autoload-dev' => [
                'psr-4' => [
                    'Tests\\' => 'tests/',
                ]
            ]
        ];

        $this->assertSame($expectedContent, $parsedFile);
    }

    /**
     * @test
     */
    public function itParsesAnXMLFile()
    {
        $xmlFile = $this->fixturesPath . 'file.xml';

        $fileParser = Container::getContainer()->get('app.services.file_parser');

        $parsedFile = $fileParser->parseFile($xmlFile);

        $expectedContent = [
            '@attributes' => [
                'colors' => 'true'
            ],
            'coverage' => [
                '@attributes' => [
                    'processUncoveredFiles' => 'true'
                ],
                'include' => [
                    'directory' => './app'
                ],
            ],
            'php' => [
                'server' => [
                    '@attributes' => [
                        'name' => 'APP_ENV',
                        'value' => 'testing',
                    ],
                ],
            ],
        ];

        $this->assertSame($expectedContent, $parsedFile);
    }
}