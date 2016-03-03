<?php

namespace PandawanTechnology\RoleVizBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\HttpKernel\Kernel;

class PandawanTechnologyRoleVizExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        if (!$container->hasParameter('security.role_hierarchy.roles')) {
            return;
        }

        $template = 'PandawanTechnologyRoleVizBundle:Profiler:template_28.html.twig';

        if (-1 == version_compare(Kernel::VERSION, '2.8')) {
            $template = 'PandawanTechnologyRoleVizBundle:Profiler:template_27.html.twig';
        }

        $dataCollectorDefinition = new Definition('PandawanTechnology\RoleVizBundle\DataCollector\RoleVizDataCollector');
        $dataCollectorDefinition->setPublic(false);
        $dataCollectorDefinition->addTag('data_collector', [
            'template' => $template,
            'id' => 'credential',
        ]);
        $dataCollectorDefinition->addArgument($container->getParameter('security.role_hierarchy.roles'));

        $container->setDefinition('pandawan_technology.role_viz.data_collector', $dataCollectorDefinition);
    }
}
