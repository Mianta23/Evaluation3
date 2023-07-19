<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Typerecette
 *
 * @property int $idtyperecette
 * @property string|null $nom
 * @property string|null $type
 *
 * @package App\Models
 */
class Typerecette extends Model
{
	protected $table = 'typerecette';
	protected $primaryKey = 'idtyperecette';
	public $timestamps = false;

    protected $casts = [
		'budget' => 'float',

	];

	protected $fillable = [
		'nom',
		'typedate',
        'budget',
        'code'
	];
}
