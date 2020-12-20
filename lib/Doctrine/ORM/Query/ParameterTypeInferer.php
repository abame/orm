<?php

declare(strict_types=1);

namespace Doctrine\ORM\Query;

use DateInterval;
use DateTimeInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;
use function current;
use function is_array;
use function is_bool;
use function is_int;

/**
 * Provides an enclosed support for parameter inferring.
 */
class ParameterTypeInferer
{
    /**
     * Infers type of a given value, returning a compatible constant:
     * - Type (\Doctrine\DBAL\Types\Type::*)
     * - Connection (\Doctrine\DBAL\Connection::PARAM_*)
     *
     * @deprecated Infer Type will be removed in the future for setParameter method,
     * - Consider adding the type as third argument to setParameter method since null will not be accepted anymore
     * @param mixed $value Parameter value.
     *
     * @return mixed Parameter type constant.
     */
    public static function inferType($value)
    {
        if (is_int($value)) {
            return Types::INTEGER;
        }

        if (is_bool($value)) {
            return Types::BOOLEAN;
        }

        if ($value instanceof DateTimeInterface) {
            return Types::DATETIME_MUTABLE;
        }

        if ($value instanceof DateInterval) {
            return Types::DATEINTERVAL;
        }

        if (is_array($value)) {
            return is_int(current($value))
                ? Connection::PARAM_INT_ARRAY
                : Connection::PARAM_STR_ARRAY;
        }

        return Types::STRING;
    }
}
