<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\School
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $municipality_id
 * @property int $school_id
 * @property string $code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $name
 * @property-read \App\DiagnosticResult $diagnosticResult
 * @property-read \App\Municipality $municipality
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereMunicipalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\School whereUpdatedAt($value)
 */
class School extends Model
{

    protected $fillable = [
        'municipality_id',
        'name',
        'code'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipality()
    {
        return $this->hasOne(Municipality::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diagnosticResult()
    {
        return $this->belongsTo(DiagnosticResult::class);
    }

    /**
     * Возвращает ID школы по её имени, коду и ID региона,
     * если таких нет, тогда добавляет и возвращает новый ID
     *
     * @param $municipalityID
     * @param $name
     * @param $code
     * @return Model|int|mixed|null|string|static
     */
    public function retrieveIDorAdd($municipalityID, $name, $code)
    {
        $result = '';
        if (!empty($name)){
            $municipalityID = is_null($municipalityID) ? 0 : $municipalityID;
            $result = $this->firstOrCreate(
                [
                    'municipality_id' => $municipalityID,
                    'code' => $code,
                ],
                [
                    'name' => $name,
                ]
            )->id;
        }
        return $result;
    }
}
