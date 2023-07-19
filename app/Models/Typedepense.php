<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Typedepense
 *
 * @property int $idtypedepense
 * @property string|null $nom
 * @property string|null $type
 *
 * @package App\Models
 */
class Typedepense extends Model
{
	protected $table = 'typedepense';
	protected $primaryKey = 'idtypedepense';
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
