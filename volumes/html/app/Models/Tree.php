<?php

namespace App\Models;

use App\Interface\PlantableInterfece;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $tiles
 * @property int $height
 */
class Tree extends Model implements PlantableInterfece
{

    public function getId()
    {
        return $this->id;
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
     * @return int
     */
    public function getTiles(): int
    {
        return $this->tiles;
    }

    /**
     * @param int $tiles
     */
    public function setTiles(int $tiles): void
    {
        $this->tiles = $tiles;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }
}
