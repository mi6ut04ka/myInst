<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * 
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $username
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read Collection<int, User> $followers
 * @property-read int|null $followers_count
 * @property-read Collection<int, User> $following
 * @property-read int|null $following_count
 * @property-read UserInformation|null $information
 * @property-read Collection<int, User> $likes
 * @property-read int|null $likes_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, Post> $posts
 * @property-read int|null $posts_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUsername($value)
 * @property-read \App\Models\Avatar|null $avatars
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password'
    ];

    public function information(): HasOne
    {
        return $this->hasOne(UserInformation::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'owner_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'followers', 'user_id', 'author_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'followers', 'author_id', 'user_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'likes', 'user_id', 'post_id');
    }

    public function avatars(): HasOne
    {
        return $this->hasOne(Avatar::class);
    }

}

