<?php
/**
 * @author Bastien SANDER <bastien@heyliot.com>
 * @copyright 2020 Heyliot (http://www.heyliot.com)
 */

namespace App\GraphQl\Type;

use ApiPlatform\Core\GraphQl\Type\TypeConverterInterface;
use GraphQL\Type\Definition\Type as GraphQLType;
use Symfony\Component\PropertyInfo\Type;

final class TypeConverter implements TypeConverterInterface
{
    private TypeConverterInterface $defaultTypeConverter;

    public function __construct(TypeConverterInterface $defaultTypeConverter)
    {
        $this->defaultTypeConverter = $defaultTypeConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function convertType(
        Type $type, bool $input, ?string $queryName, ?string $mutationName, string $resourceClass,
        string $rootResource, ?string $property, int $depth
    ) {
        if ('createdAt' === $property || 'updatedAt' === $property || (
                Type::BUILTIN_TYPE_OBJECT === $type->getBuiltinType()
                && is_a($type->getClassName(), \DateTimeInterface::class, true)
            )) {
            return 'DateTime';
        }

        return $this->defaultTypeConverter->convertType(
            $type, $input, $queryName, $mutationName, $resourceClass, $rootResource, $property, $depth
        );
    }

    /**
     * @inheritDoc
     */
    public function resolveType(string $type): ?GraphQLType
    {
        return $this->defaultTypeConverter->resolveType($type);
    }
}