<?php

declare(strict_types=1);

namespace Sunxyw\Velvet\Entities;

use JsonSerializable;

class Message implements JsonSerializable
{
    public string $time;

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}