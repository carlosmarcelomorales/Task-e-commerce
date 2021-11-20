<?php

namespace App\Application\Shared;

abstract class AbstractQuery implements QueryInterface
{
    /** @var \stdClass */
    protected $data;

    public function __construct(\stdClass $data)
    {
        $this->data = $data;
        $this->assertMandatoryAttributes();
    }

    public function getData(): \stdClass
    {
        return $this->data;
    }

    abstract public function assertMandatoryAttributes();

}
