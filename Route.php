<?php

#[Attribute]
final class Route
{
    private array $action = [];
    public function __construct(
        private readonly string $url,
        private readonly string $methods = 'GET|POST'
    ){

    }

    public function getAction(): array
    {
        return $this->action;
    }

    public function setAction(array $action): void
    {
        $this->action = $action;
    }

    public function getUrl(): string
    {
        return preg_replace('~{(.*)}~mU', '(?<$1>\S+)', $this->url);
    }

    public function getMethods(): string
    {
        return $this->methods;
    }



}