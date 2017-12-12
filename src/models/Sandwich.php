<?php
/**
* 
*/
namespace catawich\models;

use catawich\models\Image as Image;

class Sandwich extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'sandwich';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function images(){
		return $this->hasMany('catawich\models\Image', 's_id');
	}

	public function categories(){
	    return $this->belongsToMany('catawich\models\Categorie', 'sand2cat', 'sand_id', 'cat_id');
    }

	//Partie 1
	//1.1
	public static function listSandwich(){
		$request = self::select(['nom', 'description', 'type_pain'])->get();
		return $request;
	}

	//1.2
	public static function listSandwichOrder(){
		$request = self::select(['nom', 'description', 'type_pain'])->orderBy('type_pain')->get();
		return $request;
	}

	//1.3
	public static function sand42(){
		$request = self::select(['nom', 'description', 'type_pain'])->where('id', '=', 42)->first();
		if (is_null($request)){
			throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Le sandwich n'existe pas ! ",0);
		}else{
			return $request;
		}
	}

	//1.4
	public static function listTypePainBaguette(){
		$request = self::select(['nom', 'description', 'type_pain'])->where("type_pain", "like", "%baguette%")->get();
		return $request;
	}

	//1.5
	public static function insertionSandwich($nom, $desc, $type_pain){
		$sand = new Sandwich;
		$sand->nom = $nom;
		$sand->description = $desc;
		$sand->type_pain = $type_pain;
		$sand->save();
		return $sand->id;
	}

	//Partie 2
	//2.1
	public static function sand4img(){
		$request = self::find(4);
		$images = $request->images()->select("filename")->get();
		return [$request,$images];
	}

	//2.2
	public static function listSandImg(){
        $request = self::select()->orderBy('type_pain')->with('images')->get();
        return $request;
    }

    //3.1
    public static function categSand5(){
	    $sand = self::with('categorie')->where('id', '=', 5);
	    return $sand;
    }
}