<?php

declare(strict_types=1);

namespace Sunxyw\Velvet\Tests;

use Sunxyw\Velvet\Velvet;
use PHPUnit\Framework\TestCase;

class VelvetTest extends TestCase
{
    /**
     * Test if it can parse event message.
     *
     * @return void
     */
    public function testCanParseEventMessage(): void
    {
        $message = '{"id":"b6e65187-5ac0-489c-b431-53078e9d2bbb","type":"meta","sub_type":"state","trigger":{"type":"system"},"data":{},"time":1648131728}';
        $this->assertSame('meta', Velvet::parseEvent($message)->type);
    }

    /**
     * Test if it can parse action message.
     *
     * @return void
     */
    public function testCanParseActionMessage(): void
    {
        $message = '{"echo":"b6e56778-5ac0-489c-abcd-53078e9d2bbb","action":"add_whitelist","params":{},"trigger":{"type":"player","username":"sunxyw"},"time":1648131728}';
        $this->assertSame('add_whitelist', Velvet::parseAction($message)->action);
    }

    /**
     * Test if it can parse action response message.
     *
     * @return void
     */
    public function testCanParseActionResponseMessage(): void
    {
        $message = '{"echo":"","status":"ok","code":"0","message":"","data":{},"time":1648131728}';
        $this->assertSame('ok', Velvet::parseActionResponse($message)->status);
    }
}
