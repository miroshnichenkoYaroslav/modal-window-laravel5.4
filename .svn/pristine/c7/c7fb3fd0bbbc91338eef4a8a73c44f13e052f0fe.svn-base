<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Municipality
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $region_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read \App\DiagnosticResult $diagnosticResult
 * @property-read \App\Region $region
 * @property-read \App\School $school
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Municipality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Municipality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Municipality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Municipality whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Municipality whereUpdatedAt($value)
 */
class Municipality extends Model
{

    protected $fillable = [
        'name',
        'region_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function region()
    {
        return $this->hasOne(Region::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diagnosticResult()
    {
        return $this->belongsTo(DiagnosticResult::class);
    }


    /**
     * Возвращает ID муниципалитета по его имени и ID региона,
     * если таких нет, тогда добавляет и возвращает новый ID
     *
     * @param integer $regionID
     * @param string $name
     * @return Model|int|mixed|null|string|static
     */
    public function retrieveIDorAdd($regionID, $name)
    {
        $result = '';
        if (!empty($name)){
            $regionID = is_null($regionID) ? 0 : $regionID;
            $result = $this->firstOrCreate([
                'name' => $name,
                'region_id' => $regionID,
            ])->id;
        }
        return $result;
    }
}
