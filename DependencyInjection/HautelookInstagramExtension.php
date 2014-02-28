<?php

namespace Hautelook\InstagramBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class HautelookInstagramExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container
            ->getDefinition('hautelook_instagram.instaphp')
            ->replaceArgument(0, $config['instaphp_params'])
        ;

        $container
            ->getDefinition('hautelook_instagram.manager')
            ->replaceArgument(2, $config['user_id'])
        ;
    }
}
