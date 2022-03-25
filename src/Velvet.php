<?php

namespace Sunxyw\Velvet;

use InvalidArgumentException;
use Sunxyw\Velvet\Entities\Action;
use Sunxyw\Velvet\Entities\ActionResponse;
use Sunxyw\Velvet\Entities\Event;
use Sunxyw\Velvet\Entities\Trigger;

class Velvet
{
    /**
     * Parse Velvet protocol raw event message.
     *
     * @param string $message Raw event message from Velvet client
     * @return Event
     */
    public static function parseEvent(string $message): Event
    {
        return self::parseEntity($message, Event::class);
    }

    /**
     * Parse Velvet protocol raw action message.
     *
     * @param string $message Raw action message from Velvet client
     * @return Action
     */
    public static function parseAction(string $message): Action
    {
        return self::parseEntity($message, Action::class);
    }

    /**
     * Parse Velvet protocol raw action response message.
     *
     * @param string $message Raw action response message from Velvet client
     * @return ActionResponse
     */
    public static function parseActionResponse(string $message): ActionResponse
    {
        return self::parseEntity($message, ActionResponse::class);
    }

    /**
     * Parse a JSON string.
     *
     * @param string $message
     * @return array
     */
    private static function parseJson(string $message): array
    {
        try {
            return json_decode($message, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            throw new InvalidArgumentException('Invalid JSON format.');
        }
    }

    /**
     * Map data to object.
     *
     * @template T
     *
     * @param array $data
     * @param string<T> $className
     * @return T
     */
    private static function mapDataToObject(array $data, string $className)
    {
        $object = new $className();
        foreach (get_class_vars($className) as $key => $value) {
            $key = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
            if (isset($data[$key])) {
                if ($key === 'trigger') {
                    $type = $data[$key]['type'];
                    unset($data[$key]['type']);
                    $data = $data[$key];
                    $data[$key] = new Trigger($type, $data);
                }
                $object->$key = $data[$key];
            } else {
                throw new InvalidArgumentException("Missing property '$key' in data.");
            }
        }
        return $object;
    }

    /**
     * Parse raw message to an entity.
     *
     * @template T
     *
     * @param string $message
     * @param string<T> $className
     * @return T
     */
    private static function parseEntity(string $message, string $className)
    {
        $data = self::parseJson($message);

        return self::mapDataToObject($data, $className);
    }
}