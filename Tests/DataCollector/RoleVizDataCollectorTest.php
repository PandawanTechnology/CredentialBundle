<?php

namespace PandawanTechnology\RoleVisualisationBundle\Tests\DataCollector;

use PandawanTechnology\RoleVizBundle\DataCollector\RoleVizDataCollector;

class RoleVizDataCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderGetSorted
     *
     * @param array $input
     * @param array $expected
     */
    public function testGetSorted($input, $expected)
    {
        $dataCollector = new RoleVizDataCollector($input);
        $this->assertEquals($expected, $dataCollector->getSorted());
    }

    public function testGetName()
    {
        $dataCollector = new RoleVizDataCollector();
        $this->assertEquals('credential', $dataCollector->getName());
    }

    public function dataProviderGetSorted()
    {
        return [
            [[], []],
            [['ROLE_ADMIN' => ['ROLE_USER']], [
                'ROLE_ADMIN' => ['ROLE_USER' => []],
                'ROLE_USER' => [],
            ]],
            [
                ['ROLE_ADMIN' => ['ROLE_USER'], 'ROLE_SUPER_ADMIN' => ['ROLE_ADMIN']],
                [
                    'ROLE_ADMIN' => ['ROLE_USER' => []],
                    'ROLE_USER' => [],
                    'ROLE_SUPER_ADMIN' => ['ROLE_ADMIN' => ['ROLE_USER' => []]],
                ],
            ],
            [
                ['ROLE_READER' => ['ROLE_USER'], 'ROLE_WRITER' => ['ROLE_USER'], 'ROLE_ADMIN' => ['ROLE_READER', 'ROLE_WRITER']],
                [
                    'ROLE_READER' => ['ROLE_USER' => []],
                    'ROLE_USER' => [],
                    'ROLE_WRITER' => ['ROLE_USER' => []],
                    'ROLE_ADMIN' => ['ROLE_READER' => ['ROLE_USER' => []], 'ROLE_WRITER' => ['ROLE_USER' => []]],
                ],
            ],
        ];
    }
}
