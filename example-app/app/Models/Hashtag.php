<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 
 *
 * @mixin IdeHelperHashtag
 * @property int $id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Hashtag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hashtag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hashtag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hashtag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hashtag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hashtag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hashtag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hashtag extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded =[];

    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
