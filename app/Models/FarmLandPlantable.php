<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property int $farmland_id
 * @property string $plantable_type
 * @property int $plantable_id
 * @property int $count
 * @property Carbon $planted_at
 * @property Carbon $harvested_at
 */
class FarmLandPlantable extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'farmland_plantable';
    protected $guarded = ['id'];

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
    public function getFarmlandId(): int
    {
        return $this->farmland_id;
    }

    /**
     * @param int $farmland_id
     */
    public function setFarmlandId(int $farmland_id): void
    {
        $this->farmland_id = $farmland_id;
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
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    /**
     * @return Carbon
     */
    public function getPlantedAt(): Carbon
    {
        return $this->planted_at;
    }

    /**
     * @param Carbon $planted_at
     */
    public function setPlantedAt(Carbon $planted_at): void
    {
        $this->planted_at = $planted_at;
    }

    /**
     * @return Carbon
     */
    public function getHarvestedAt(): Carbon
    {
        return $this->harvested_at;
    }

    /**
     * @param Carbon $harvested_at
     */
    public function setHarvestedAt(Carbon $harvested_at): void
    {
        $this->harvested_at = $harvested_at;
    }
}
