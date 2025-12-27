<?php

namespace Cymphone\Container;

use Closure;
use ReflectionClass;
use ReflectionParameter;

class Container
{
    private array $bindings = [];
    private array $singletons = [];

    public function bind(string $abstract, $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function singleton(string $abstract, $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
        $this->singletons[$abstract] = true;
    }

    public function make(string $abstract)
    {
        if (isset($this->singletons[$abstract]) && isset($this->singletons[$abstract . '_instance'])) {
            return $this->singletons[$abstract . '_instance'];
        }

        $concrete = $this->bindings[$abstract] ?? $abstract;

        if ($concrete instanceof Closure) {
            $instance = $concrete($this);
        } elseif (is_string($concrete) && class_exists($concrete)) {
            $instance = $this->build($concrete);
        } else {
            $instance = $concrete;
        }

        if (isset($this->singletons[$abstract])) {
            $this->singletons[$abstract . '_instance'] = $instance;
        }

        return $instance;
    }

    private function build(string $class)
    {
        $reflector = new ReflectionClass($class);

        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class {$class} is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $class();
        }

        $dependencies = [];
        foreach ($constructor->getParameters() as $parameter) {
            $dependency = $parameter->getType();
            
            if ($dependency === null) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Cannot resolve dependency {$parameter->getName()}");
                }
            } else {
                $dependencyName = $dependency->getName();
                $dependencies[] = $this->make($dependencyName);
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}

