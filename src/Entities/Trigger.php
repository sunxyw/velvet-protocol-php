<?php

declare(strict_types=1);

namespace Sunxyw\Velvet\Entities;

class Trigger
{
    public string $type;

    public string $data;

    /**
     * Trigger constructor.
     *
     * @param string $type
     * @param string $data
     */
    public function __construct(string $type, string $data)
    {
        $this->type = $type;
        $this->data = $data;
    }


    /**
     * Determine if the trigger is input type.
     *
     * @param string $type
     * @return bool
     */
    public function is(string $type): bool
    {
        return $this->type === $type;
    }
}