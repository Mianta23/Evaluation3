<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Administrateur
 * 
 * @property int $idadminserial
 * @property string|null $nomadmin
 * @property string|null $email
 * @property string|null $mdp
 *
 * @package App\Models
 */
class Administrateur extends Model
{
	protected $table = 'administrateur';
	protected $primaryKey = 'idadminserial';
	public $timestamps = false;

	protected $fillable = [
		'nomadmin',
		'email',
		'mdp'
	];
}
