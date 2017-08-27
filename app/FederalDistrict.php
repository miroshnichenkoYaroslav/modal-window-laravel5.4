<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\FederalDistrict
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FederalDistrict whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FederalDistrict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FederalDistrict whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FederalDistrict whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FederalDistrict whereUpdatedAt($value)
 */
class FederalDistrict extends Model
{
    protected $casts = [
        'id' => 'string',
    ];


    public function region()
    {
        $this->belongsTo(Region::class);
    }
}
