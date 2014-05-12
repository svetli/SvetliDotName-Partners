<?php

namespace SvetliDotName\Bundle\PartnerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This class load bundle configuration
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class SvetliDotNamePartnerExtension extends Extension
{
    public function load(array $cfg, ContainerBuilder $container)
    {
        $config = new Configuration();
        $this->processConfiguration($config, $cfg);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}

