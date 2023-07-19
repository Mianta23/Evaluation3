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
class Facture_recette extends Model
{
	protected $table = 'facture_recette';
	protected $primaryKey = 'idfacturerecette';
	public $timestamps = false;

    protected $casts = [
		'idpatient' => 'int',
		'datefacturerecette' => 'datetime',
	];


	protected $fillable = [
		'idpatient',
		'datefacturerecette'
	];

	public function patient()
	{
		return $this->belongsTo(Patient::class, 'idpatient');
	}
}
