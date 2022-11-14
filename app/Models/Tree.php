<?php

namespace App\Models;

use App\Interface\PlantableInterfece;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $name
 * @property int $tiles
 * @property int $height
 */
class Tree extends Model implements PlantableInterfece
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
