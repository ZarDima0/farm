<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property integer $price
 * @property boolean $availability
 * @property string $entityType
 * @property integer $entityId
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @return morphTo
     */
    public function product()
    {
        return $this->morphTo();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return $this
     */
    public function setPrice(int $price): Product
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAvailability(): bool
    {
        return $this->availability;
    }

    /**
     * @param bool $availability
     * @return $this
     */
    public function setAvailability(bool $availability): Product
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }

    /**
     * @param string $entityType
     * @return Product
     */
    public function setEntityType(string $entityType): Product
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @return int
     */
    public function getEntityId(): int
    {
        return $this->entityId;
    }

    /**
     * @param int $entityId
     * @return Product
     */
    public function setEntityId(int $entityId): Product
    {
        $this->entityId = $entityId;

        return $this;
    }
}
