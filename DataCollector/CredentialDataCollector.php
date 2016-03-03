<?php

namespace PandawanTechnology\CredentialBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class CredentialDataCollector implements DataCollectorInterface
{
    /**
     * @var array
     */
    protected $credentials;

    /**
     * @param array           $credentials
     */
    public function __construct(array $credentials = [])
    {
        $this->credentials = $credentials;
    }

    /**
     * @return array
     */
    public function getSorted()
    {
        return $this->sort($this->credentials);
    }

    /**
     * @codeCoverageIgnore
     * @inheritDoc
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'credential';
    }

    /**
     * @param array $credentials
     * @param array $result
     *
     * @return array
     */
    private function sort(array $credentials, array $result = [])
    {
        foreach ($credentials as $name => $parents) {
            if (!isset($result[$name]) && !is_int($name)) {
                $result[$name] = [];
            }

            if (!count($parents) || !is_array($parents)) {
                continue;
            }

            foreach ($parents as $parentName) {
                if (!isset($result[$parentName])) {
                    $result[$parentName] = [];
                }

                if (isset($result[$name][$parentName])) {
                    continue;
                }

                $result[$name][$parentName] = $result[$parentName];

                if (!isset($credentials[$parentName])) {
                    continue;
                }

                $result = $this->sort($credentials[$parentName], $result);
            }
        }

        return $result;
    }
}
