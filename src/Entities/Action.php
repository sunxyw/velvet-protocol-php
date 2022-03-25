<?php

declare(strict_types=1);

namespace Sunxyw\Velvet\Entities;

use Sunxyw\Velvet\Entities\Traits\HasTrigger;

class Action extends Message
{
    use HasTrigger;

    public string $echo;

    public string $action;

    public array $params;
}