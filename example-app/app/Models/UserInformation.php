<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @mixin IdeHelperUserInformation
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $bio
 * @property string|null $birthday
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereUserId($value)
 * @mixin \Eloquent
 */
class UserInformation extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
