<?php

declare(strict_types=1);

namespace Sunxyw\Velvet\Entities;

use Sunxyw\Velvet\Entities\Traits\HasTrigger;

class Event extends Message
{
    use HasTrigger;

    public string $id;

    public string $type;

    public string $subType;

    public array $data;

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        $vars = parent::jsonSerialize();
        $vars['sub_type'] = $vars['subType'];
        unset($vars['subType']);
        return $vars;
    }
}