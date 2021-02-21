<?php

namespace App\DependencyInjection;

use Psr\Container\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Container
{
    /**
     * @var string
     */
    private $config;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct()
    {
        $this->config = __DIR__.'/../config';

        if ($this->container === null) {
            $this->container = new ContainerBuilder();
            $this->loadConfig();
        }

        return $this->container;
    }

    /**
     * Loads the services.
     *
     * @throws \Exception
     */
    private function loadConfig()
    {
        $loader = new YamlFileLoader($this->container, new FileLocator($this->config));
        $loader->load('services.yaml');
    }

    public static function getContainer(): ContainerInterface
    {
        return (new self())->container;
    }
}