<?php

namespace dummy;

class SpecimenClass
{
    /**
     * value
     *
     * @var string
     */
    private $value;

    /**
      * number
      *
      * @var int
      */
    private $number;


    public function __construct(string $value = "", int $number = 0)
    {
        $this->value  = $value;
        $this->number = $number;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function setNumber(int $number): void
    {
         $this->number = $number;
    }
}
