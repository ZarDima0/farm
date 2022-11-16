<?php

namespace App\Models;

use App\Interface\PlantableInterfece;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property boolean $is_harvestable
 * @property boolean $is_perennial
 */
class Plant extends Model implements PlantableInterfece
{

    use HasApiTokens, HasFactory, Notifiable;

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

    public function crop()
    {
        return $this->morphOne(Crop::class, 'plantable');
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
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isIsHarvestable(): bool
    {
        return $this->is_harvestable;
    }

    /**
     * @param bool $is_harvestable
     */
    public function setIsHarvestable(bool $is_harvestable): void
    {
        $this->is_harvestable = $is_harvestable;
    }

    /**
     * @return bool
     */
    public function isIsPerennial(): bool
    {
        return $this->is_perennial;
    }

    /**
     * @param bool $is_perennial
     */
    public function setIsPerennial(bool $is_perennial): void
    {
        $this->is_perennial = $is_perennial;
    }
}
