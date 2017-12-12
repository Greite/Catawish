<?php
/**
* 
*/
namespace catawich\models;

class Image extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'image';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function sandwich(){
		return $this->belongsTo('catawich\models\Sandwich', 's_id');
	}

	//2.3
	public static function listImgSand(){
		$request = self::with('sandwich')->get();
		return $request;
	}

	//2.4
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

    //2.5
    public static function modifIdImage3(){
        $img = Image::find(39);
        $img->s_id = 6;
        return $img->save();
    }
}