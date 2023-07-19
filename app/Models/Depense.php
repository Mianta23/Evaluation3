<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Depense
 *
 * @property int $iddepense
 * @property int|null $idtypedepense
 * @property Carbon|null $date_depense
 * @property float|null $montant_total
 *
 * @property Typedepense|null $typedepense
 *
 * @package App\Models
 */
class Depense extends Model
{
	protected $table = 'depense';
	protected $primaryKey = 'iddepense';
	public $timestamps = false;

	protected $casts = [
        'datedepense' => 'datetime',
		'idtypedepense' => 'int',
		'montant' => 'float',
        'nombre' => 'int',
        
	];

	protected $fillable = [
        'datedepense',
		'idtypedepense',
		'montant',
        'nombre'
	];

	public function typedepense()
	{
		return $this->belongsTo(Typedepense::class, 'idtypedepense');
	}
}
