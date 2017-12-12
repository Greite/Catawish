<?php
/**
* 
*/
namespace catawich\models;

use catawich\models\Sandwich;

class Image extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'image';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function sandwich() {
       return $this->belongsTo('catawich\models\Sandwich', 's_id');
	}

	//Question 2.3
	public static function allimgsand() {;
		$sandimages = self::with("sandwich")->get();
		return $sandimages;
	}

	//Question 2.4
    public static function insertionImage($titre, $def_x, $def_y, $taille, $filename, $s_id){
        $img = new Image;
        $img->titre=$titre;
        $img->def_x=$def_x;
        $img->def_y=$def_y;
        $img->taille=$taille;
        $img->filename=$filename;
        $img->s_id=$s_id;
        $img->save();
        return $img->id;
    }

    //Question 2.5
    public static function modifIdImage3($id){
        $img = Image::find($id);
        $img->s_id = 6;
        return $img->save();
    }
}