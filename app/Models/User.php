<?php
namespace App\Models;

use App\Enums\DigestFrequency;
use App\Notifications\QueueableVerifyEmailNotificaition;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
     * Send the email verification notification.
     *
     * @return void
     */

    protected static function booted(): void
    {
        static::deleted(function (User $user) {
            DeletedUser::create($user->only(['name', 'email']));
        });
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new QueueableVerifyEmailNotificaition);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
            'last_logged_in_at' => 'datetime',
            'digest_frequency'  => DigestFrequency::class,
        ];
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (blank($this->avatar_url)) {
                    $name = str($this->name)->squish()->words(2, '')->replace(' ', '+');

                    return "https://ui-avatars.com/api/?name={$name}&background=ffd0d2&color=EF5A6F&rounded=true&bold=true";
                }

                if (isset(parse_url($this->avatar_url)['host'])) {
                    return $this->avatar_url;
                }

                return asset(str($this->avatar_url)->prepend('storage/'));
            }
        )->shouldCache();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasVerifiedEmail() && $this->is_admin;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function isRegisteredWithProvider(): bool
    {
        return filled($this->provider) && filled($this->provider_id);
    }

    public function updateLastLoggedInAt(): void
    {
        $this->last_logged_in_at = now();

        $this->save();
    }
}
