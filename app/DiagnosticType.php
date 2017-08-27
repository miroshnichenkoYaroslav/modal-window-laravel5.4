<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\DiagnosticType
 *
 * @property int    $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DiagnosticFile[] $diagnosticFiles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\DiagnosticType onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DiagnosticType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DiagnosticType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DiagnosticType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DiagnosticType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\DiagnosticType withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DiagnosticFile[] $diagnosticFile
 */
class DiagnosticType extends Model
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
        'name'
    ];


    public function diagnosticFile()
    {
        return $this->hasMany(DiagnosticFile::class, 'diagnostic_type_id');
    }
}
