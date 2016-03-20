<?php

namespace DBBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class DBExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        //$loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'\..\Resources\config'));
        //$loader->load('services.xml');
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'\..\Resources\config'));
        $loader->load('admin.yml');
    }
}