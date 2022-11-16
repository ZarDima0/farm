<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $building_id
 * @property int $farm_id
 */
class FarmBuilding extends Model
{
    use HasFactory;

    protected $table = 'buildings-farm';

    /**
     * @return belongsTo
     */
    public function building():belongsTo
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * @return belongsTo
     */
    public function farmLand():belongsTo
    {
        return $this->belongsTo(FarmLand::class);
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
    public function getBuildingId(): int
    {
        return $this->building_id;
    }

    /**
     * @param int $building_id
     */
    public function setBuildingId(int $building_id): void
    {
        $this->building_id = $building_id;
    }

    /**
     * @return int
     */
    public function getFarmId(): int
    {
        return $this->farm_id;
    }

    /**
     * @param int $farm_id
     */
    public function setFarmId(int $farm_id): void
    {
        $this->farm_id = $farm_id;
    }
}
