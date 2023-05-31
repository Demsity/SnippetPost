<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url'
    ];

    public function addFollowUser($auth_user, $following_user)
    {
        $follow = new UserFollow;
        $follow->primary_user_id = $auth_user;
        $follow->following_user_id = $following_user;
        $follow->save();
    }

    public function removeFollowUser($auth_user, $following_user)
    {
        UserFollow::where('primary_user_id', $auth_user)->where('following_user_id', $following_user)->delete();
    }

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
        'password' => 'hashed',
    ];

    public function canAccessFilament(): bool
    {
        return true;
        //return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function post_likes(): BelongsToMany
    {
        return $this->belongsToMany(user_like_post::class, 'user_like_post');
    }
}
