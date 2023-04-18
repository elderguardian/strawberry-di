<?php

class Kernel implements IKernel
{
    function get(string $contract)
    {
        $mappings = include "mappings.php";
        $class = $mappings[$contract];
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