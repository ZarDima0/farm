<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $building_id
 */
class BuildingFarm extends Model
{
    use HasFactory;

    protected $table = 'buildings-farm';

    /**
     * @return belongsTo
     */
    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return belongsTo
     */
    public function building():belongsTo
    {
        return $this->belongsTo(User::class);
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
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
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
}
