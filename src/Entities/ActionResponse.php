<?php

declare(strict_types=1);

namespace Sunxyw\Velvet\Entities;

class ActionResponse extends Message
{
    public string $echo;

    public string $status;

    public int $code;

    public string $message;

    public array $data;
}