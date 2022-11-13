<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $name
 * @property boolean $is_harvestable
 * @property boolean $is_perennial
 */
class Plant extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public function crop()
    {
        return $this->morphMany(Crop::class, 'cropTable');
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
