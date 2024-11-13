<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Post
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $owner
 * @property int $owner_id
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read Collection<int, Hashtag> $hashtags
 * @property-read int|null $hashtags_count
 * @property-read Collection<int, User> $likes
 * @property-read int|null $likes_count
 * @property-read Collection<int, Photo> $photos
 * @property-read int|null $photos_count
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereOwnerId($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function photos(): HasMany
    {
        return $this->HasMany(Photo::class);
    }

    public function hashtags(): BelongsToMany
    {
        return $this->belongsToMany(Hashtag::class, 'hashtag_post', 'post_id', 'hashtag_id');
    }

    public function comments(): HasMany
    {
        return $this->HasMany(Comment::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }
}
