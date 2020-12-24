<?php

namespace dummy;

class dummyclass
{
    /**
     * value
     *
     * @var string
     */
    private $value;

    public function __construct( string $value = "")
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}