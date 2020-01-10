<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Exam
 * @package App\Entity
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $category
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Exam extends Model
{
    public $timestamps = false;

    public const NEWS  = 1;
    public const JOB   = 2;
    public const OFFICE   = 3;

    protected $fillable = ['id', 'title','url','category'];

    protected $casts = [
        'timestamp' => [
            'created_at',
            'updated_at'
        ],
    ];
}
