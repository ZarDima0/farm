<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property int $tiles
 */
class Building extends Model
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
}
