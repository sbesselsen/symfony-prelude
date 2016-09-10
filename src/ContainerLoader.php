<?php
namespace SymfonyPrelude;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class ContainerLoader
{
    /**
     * @param string $rootDirectory
     * @return \Symfony\Component\DependencyInjection\TaggedContainerInterface
     */
    public static function containerForDirectory($rootDirectory)
    {
        $container = new ContainerBuilder();
        $container->setParameter('root_dir', $rootDirectory);

        $appDir = $rootDirectory . DIRECTORY_SEPARATOR . 'app';
        $locator = new FileLocator($appDir);
        $loader = new YamlFileLoader($container, $locator);
        $loader->load('services.yml');
        $loader->load('parameters.yml');
        try {
            $loader->load('override.yml');
        } catch (\InvalidArgumentException $e) {
            // Local override files are not required.
        }

        return $container;
    }
}
