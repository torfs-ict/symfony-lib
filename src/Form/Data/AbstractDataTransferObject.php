<?php

namespace TorfsICT\Form\Data;

use ReflectionClass;
use Symfony\Component\PropertyAccess\PropertyAccess;
use TorfsICT\Entity\EntityInterface;

abstract class AbstractDataTransferObject implements DataTransferObjectInterface
{
    final public function __construct()
    {
    }

    /**
     * @param EntityInterface|DataTransferObjectInterface $src
     * @param EntityInterface|DataTransferObjectInterface $dst
     * @return EntityInterface|DataTransferObjectInterface The destination object
     */
    private function sync($src, $dst)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $class = new ReflectionClass($this);
        foreach($class->getProperties() as $property) {
            $property = $property->getName();
            if (!$accessor->isReadable($src, $property)) continue;
            if (!$accessor->isWritable($dst, $property)) continue;
            $value = $accessor->getValue($src, $property);
            $accessor->setValue($dst, $property, $value);
        }
        return $dst;
    }

    public function fromEntity(EntityInterface $entity): DataTransferObjectInterface
    {
        return $this->sync($entity, $this);
    }

    public function toEntity(EntityInterface $entity): EntityInterface
    {
        return $this->sync($this, $entity);
    }
}