<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @mixin IdeHelperPhoto
 * @property int $id
 * @property string $uuid
 * @property int $post_id
 * @property string $path
 * @property-read \App\Models\Post|null $post
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereUuid($value)
 * @mixin \Eloquent
 */
class Photo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded =[];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}
