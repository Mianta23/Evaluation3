<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Patient
 *
 * @property int $idpatient
 * @property string|null $nom
 * @property Carbon|null $date_naissance
 * @property int|null $idgenre
 *
 * @property Genre|null $genre
 *
 * @package App\Models
 */
class Patient extends Model
{
	protected $table = 'patient';
	protected $primaryKey = 'idpatient';
	public $timestamps = false;

	protected $casts = [
		'datenaissance' => 'datetime',
		'remboursement' => 'boolean'
	];

	protected $fillable = [
		'nom',
		'datenaissance',
		'sexe',
        'remboursement'
	];

	
}
