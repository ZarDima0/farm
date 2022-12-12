<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property boolean $premium
 * @property carbon|null $endPremium
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function farmland():HasMany
    {
        return $this->hasMany(FarmLand::class);
    }

    /**
     * @return HasOne
     */
    public function wallet():HasOne
    {
        return $this->HasOne(Wallet::class);
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isPremium(): bool
    {
        return $this->premium;
    }

    /**
     * @param bool $premium
     */
    public function setPremium(bool $premium): void
    {
        $this->premium = $premium;
    }

    /**
     * @return Carbon|null
     */
    public function getEndPremium(): ?Carbon
    {
        return $this->endPremium;
    }

    /**
     * @param Carbon|null $endPremium
     */
    public function setEndPremium(?Carbon $endPremium): void
    {
        $this->endPremium = $endPremium;
    }
}
