<?php
/**
* 
*/
namespace catawich\models;

use catawich\models\Image;

class tailleSandwich extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'taille_sandwich';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function sandwichs(){
        return $this->belongsToMany('catawich\models\Sandwich', 'tarif', 'taille_id', 'sand_id')->withPivot("prix");
    }
}