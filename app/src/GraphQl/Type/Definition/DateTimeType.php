<?php
/**
 * @author Bastien SANDER <bastien@heyliot.com>
 * @copyright 2020 Heyliot (http://www.heyliot.com)
 */

namespace App\GraphQl\Type\Definition;

use DateTime;
use ApiPlatform\Core\GraphQl\Type\Definition\TypeInterface;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;

final class DateTimeType extends ScalarType implements TypeInterface
{
    const NAME = 'DateTime';

    public function __construct()
    {
        $this->description = 'The `DateTime` scalar type represents time data.';

        parent::__construct();
    }

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($value)
    {
        // Already serialized.
        if (\is_string($value)) {
            return (new DateTime($value))->format('d-m-Y h:m:s');
        }

        if (!($value instanceof DateTime)) {
            throw new Error(sprintf('Value must be an instance of DateTime to be represented by DateTime: %s', Utils::printSafe($value)));
        }

        return $value->format(DateTime::ATOM);
    }

    /**
     * {@inheritdoc}
     */
    public function parseValue($value)
    {
        if (!\is_string($value)) {
            throw new Error(
                sprintf('DateTime cannot represent non string value: %s', Utils::printSafeJson($value))
            );
        }

        if (false === DateTime::createFromFormat(DateTime::ATOM, $value)) {
            throw new Error(
                sprintf('DateTime cannot represent non date value: %s', Utils::printSafeJson($value))
            );
        }

        // Will be denormalized into a DateTime.
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function parseLiteral($valueNode, ?array $variables = null)
    {
        if (
            $valueNode instanceof StringValueNode
            && false !== DateTime::createFromFormat(DateTime::ATOM, $valueNode->value)
        ) {
            return $valueNode->value;
        }

        // Intentionally without message, as all information already in wrapped Exception
        throw new \Exception();
    }
}