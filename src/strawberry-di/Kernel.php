<?php

class Kernel implements IKernel
{
    private array $mappings;

    public function __construct(array $mappings)
    {
        $this->mappings = $mappings;
    }

    function get(string $contract)
    {
        $class = $this->mappings[$contract];
        $params = $this->getParameters($class);
        $paramsAsObjects = [];

        foreach ($params as $param)
            $paramsAsObjects[] = $this->get($param->getType()->getName());

        return new $class(...$paramsAsObjects);
    }

    function getParameters($class): array
    {
        $reflection = new ReflectionClass($class);

        try {
            $constructor = $reflection->getMethod('__construct');
            $params = $constructor->getParameters();
        } catch (ReflectionException $e) {
            $params = [];
        }

        return $params;
    }

}