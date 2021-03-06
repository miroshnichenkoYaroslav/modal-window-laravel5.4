<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\DiagnosticSubject
 *
 * @property int    $id
 * @property string $name
 * @property int    $diagnostic_type_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DiagnosticFile[] $diagnosticFile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\DiagnosticSubject onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DiagnosticSubject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DiagnosticSubject whereDiagnosticTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DiagnosticSubject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DiagnosticSubject whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DiagnosticSubject withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\DiagnosticSubject withoutTrashed()
 * @mixin \Eloquent
 */
class DiagnosticSubject extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'diagnostic_type_id'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diagnosticFile()
    {
        return $this->hasMany(DiagnosticFile::class, 'diagnostic_subject_id');
    }

    public function idByName($name)
    {
        $result = $this->where('name', $name)->first();
        if ($result) {
            return $result->id;
        }
        return $result;
    }
}
