<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $daysAmount
 */

class Premium extends Model
{
    use HasFactory;

    public function shop()
    {
        return $this->morphTo(Premium::class, 'product');
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): Premium
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): Premium
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getDaysAmount(): int
    {
        return $this->daysAmount;
    }

    /**
     * @param int $daysAmount
     */
    public function setDaysAmount(int $daysAmount): Premium
    {
        $this->daysAmount = $daysAmount;

        return $this;
    }
}
