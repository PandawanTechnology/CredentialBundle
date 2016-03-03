<?php

namespace PandawanTechnology\CredentialBundle\Tests\DataCollector;

use PandawanTechnology\CredentialBundle\DataCollector\CredentialDataCollector;

class CredentialDataCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderGetSorted
     *
     * @param array $input
     * @param array $expected
     */
    public function testGetSorted($input, $expected)
    {
        $dataCollector = new CredentialDataCollector($input);
        $this->assertEquals($expected, $dataCollector->getSorted());
    }

    public function testGetName()
    {
        $dataCollector = new CredentialDataCollector();
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
                    'ROLE_USER'  => [],
                    'ROLE_SUPER_ADMIN' => ['ROLE_ADMIN' => ['ROLE_USER' => []]],
                ]
            ],
            [
                ['ROLE_READER' => ['ROLE_USER'], 'ROLE_WRITER' => ['ROLE_USER'], 'ROLE_ADMIN' => ['ROLE_READER', 'ROLE_WRITER']],
                [
                    'ROLE_READER' => ['ROLE_USER' => []],
                    'ROLE_USER'  => [],
                    'ROLE_WRITER' => ['ROLE_USER' => []],
                    'ROLE_ADMIN' => ['ROLE_READER' => ['ROLE_USER' => []], 'ROLE_WRITER' => ['ROLE_USER' => []]],
                ]
            ],
        ];
    }
}
