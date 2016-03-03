<?php

namespace PandawanTechnology\RoleVizBundle\Tests\DependencyInjection;

use PandawanTechnology\RoleVizBundle\DependencyInjection\PandawanTechnologyRoleVizExtension;

class PandawanTechnologyRoleVizExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PandawanTechnologyRoleVizExtension
     */
    protected $extension;

    protected function setUp()
    {
        $this->extension = new PandawanTechnologyRoleVizExtension();
    }

    public function testLoadNoRolesParameter()
    {
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->setMethods(['hasParameter'])
            ->disableOriginalConstructor()
            ->getMock();

        $container->expects($this->once())
            ->method('hasParameter')
            ->with($this->equalTo('security.role_hierarchy.roles'))
            ->will($this->returnValue(false));

        $container->expects($this->never())
            ->method('setDefinition');

        $this->extension->load([], $container);
    }

    public function testLoad()
    {
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->setMethods(['hasParameter', 'setDefinition', 'getParameter'])
            ->disableOriginalConstructor()
            ->getMock();

        $roles = ['ROLE_USER' => [], 'ROLE_ADMIN' => ['ROLE_USER']];

        $container->expects($this->once())
            ->method('hasParameter')
            ->with($this->equalTo('security.role_hierarchy.roles'))
            ->will($this->returnValue(true));
        $container->expects($this->once())
            ->method('getParameter')
            ->with($this->equalTo('security.role_hierarchy.roles'))
            ->will($this->returnValue($roles));
        $container->expects($this->once())
            ->method('setDefinition')
            ->with($this->equalTo('pandawan_technology.role_viz.data_collector'));

        $this->extension->load([], $container);
    }
}
