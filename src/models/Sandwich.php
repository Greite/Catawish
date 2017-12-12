<?php
/**
* 
*/
namespace catawich\models;

use catawich\models\Image;

class Sandwich extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'sandwich';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function images() {
       return $this->hasMany('catawich\models\Image', 's_id');
	}

	public function categories(){
	    return $this->belongsToMany('catawich\models\Categorie', 'sand2cat', 'sand_id', 'cat_id');
    }

	/* PARTIE 1 */

	//Question 1.1
	public static function listSandwich() {
		$request = self::select(['nom', 'description','type_pain'])->get();
		return $request;
	}

	//Question 1.2
	public static function listSandwichOrderBy() {
		$request = self::select(['nom', 'description','type_pain'])->orderBy('type_pain')->get();
		return $request;
	}

	//Question 1.3
	public static function sandwich42() {
		$request = self::select(['nom', 'description','type_pain'])->where('id', '=', 42)->first();
		if (is_null($request)) {
			throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Le sandwich n'existe pas !");
		}
		return $request;
	}

	//Question 1.4
	public static function listTypePainBaguette() {
		$request = self::select(['nom', 'description','type_pain'])->where('type_pain', 'like', '%baguette%')->orderBy("type_pain")->get();
		return $request;
	}

	//Question 1.5
	public static function newSandwich($nom, $desc, $type_pain) {
		$sand = new Sandwich;
		$sand->nom = $nom;
		$sand->description = $desc;
		$sand->type_pain = $type_pain;
		$sand->save();
		return $sand->id;
	}

	/* PARTIE 2 */

	//Question 2.1

	public static function sand4img() {
		$request = self::find(4);
		$images = $request->images()->get();
		return [$request, $images];
	}

	//Question 2.2

	public static function allsandimg() {;
		$sandimages = self::orderBy("type_pain")->with("images")->get();
		return $sandimages;
	}

	//Question 3.1

    public static function categSand5(){
	    $sand = self::find(5);
        $sand->categories;
	    return [$sand];
    }

    //Question 5.2

	public static function imagessup720sand5() {;
		$request = self::find(5);
		$images = $request->images()->where('def_x', '>', 720)->get();
		return [$request, $images];
	}

	//Question 5.6

	public static function sandimagesjpeg18000() {;
		$request = self::find(5);
		$images = $request->images()->where('type', '=', 'image/jpeg')->get();
		return [$request, $images];
	}
}