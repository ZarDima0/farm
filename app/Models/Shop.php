<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property integer $cost
 * @property boolean $availability
 * @property string $productType
 * @property integer $productId
 */
class Shop extends Model
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
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
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
     */
    public function setAvailability(bool $availability): void
    {
        $this->availability = $availability;
    }

    /**
     * @return string
     */
    public function getProductType(): string
    {
        return $this->productType;
    }

    /**
     * @param string $productType
     */
    public function setProductType(string $productType): void
    {
        $this->productType = $productType;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }
}
