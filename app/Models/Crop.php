<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $plantable_type
 * @property int $plantable_id
 * @property string $name
 * @property int $yield_per_tile

 */
class Crop extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public function cropTable()
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getPlantableType(): string
    {
        return $this->plantable_type;
    }

    /**
     * @param string $plantable_type
     */
    public function setPlantableType(string $plantable_type): void
    {
        $this->plantable_type = $plantable_type;
    }

    /**
     * @return int
     */
    public function getPlantableId(): int
    {
        return $this->plantable_id;
    }

    /**
     * @param int $plantable_id
     */
    public function setPlantableId(int $plantable_id): void
    {
        $this->plantable_id = $plantable_id;
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
     * @return int
     */
    public function getYieldPerTile(): int
    {
        return $this->yield_per_tile;
    }

    /**
     * @param int $yield_per_tile
     */
    public function setYieldPerTile(int $yield_per_tile): void
    {
        $this->yield_per_tile = $yield_per_tile;
    }
}
