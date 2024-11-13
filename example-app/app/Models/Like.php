<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property-read Post|null $post
 * @property-read User|null $user
 * @method static Builder|Like newModelQuery()
 * @method static Builder|Like newQuery()
 * @method static Builder|Like query()
 * @method static Builder|Like whereId($value)
 * @method static Builder|Like wherePostId($value)
 * @method static Builder|Like whereUserId($value)
 * @mixin \Eloquent
 */
class Like extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}
