<?php

namespace TorfsICT\Form\Data;

use TorfsICT\Entity\EntityInterface;

interface DataTransferObjectInterface
{
    /**
     * Imports the values of our Data Transfer Object from an entity object.
     *
     * @param EntityInterface $entity
     * @return $this
     */
    public function fromEntity(EntityInterface $entity): self;

    /**
     * Exports the values of our Data Transfer Object to an entity object.
     *
     * @param EntityInterface $entity
     * @return $this
     */
    public function toEntity(EntityInterface $entity): self;
}