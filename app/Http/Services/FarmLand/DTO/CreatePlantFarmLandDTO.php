<?php

namespace App\Http\Services\FarmLand\DTO;


class CreatePlantFarmLandDTO
{

    /**
     * @param int $farmland_id
     * @param string $plantable_type
     * @param int $plantable_id
     * @param int $count
     * @param string $planted_at
     * @param string $harvested_at
     */
    public function __construct(
        public int $farmland_id,
        public string $plantable_type,
        public int $plantable_id,
        public int $count,
        public string $planted_at,
        public string $harvested_at,
    ) {
    }

    /**
     * @return int
     */
    public function getFarmlandId(): int
    {
        return $this->farmland_id;
    }

    /**
     * @return string
     */
    public function getPlantableType(): string
    {
        return $this->plantable_type;
    }

    /**
     * @return int
     */
    public function getPlantableId(): int
    {
        return $this->plantable_id;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getPlantedAt(): string
    {
        return $this->planted_at;
    }

    /**
     * @return string
     */
    public function getHarvestedAt(): string
    {
        return $this->harvested_at;
    }
}
