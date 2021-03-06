<?php

namespace catawich\models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Sandwich extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes;

	protected $table = 'sandwich';
	protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
	public $timestamps = false;


    public function images() {
       return $this->hasMany('catawich\models\Image', 's_id');
	}

	public function categories(){
	    return $this->belongsToMany('catawich\models\Categorie', 'sand2cat', 'sand_id', 'cat_id');
    }

    public function tailleSandwichs(){
        return $this->belongsToMany('catawich\models\TailleSandwich', 'tarif', 'sand_id', 'taille_id')->withPivot("prix");
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

	/* PARTIE 3 */

	//Question 3.1
    public static function categSand5(){
	    $sand = self::find(5);
	    return $sand;
    }

    //Question 3.3
    public static function fonction33(){
        $sand = self::where('type_pain', 'like', '%baguette%')->get();
        return $sand;
    }

    //Question 3.4
    public static function fonction34($id_sand, $id_cat){
        $sand = self::find($id_sand);
        $sand->categories()->attach([$id_cat]);
    }

    /* PARTIE 4 */

    //Question 4.1
    public static function tailleSand5(){
        $sandTaille = self::find(5);
        $sandTaille->with('tailleSandwichs');
        return $sandTaille;
    }

    //Question 4.3
    public static function fonction43($sand_id, $taille_id, $prix){
        $sand = self::find($sand_id);
        $sand->tailleSandwichs()->attach([$taille_id=>["prix"=>$prix]]);
    }

    /* PARTIE 5 */

    //Question 5.2
    public static function fonction52() {;
        $request = self::find(5);
        $images = $request->images()->where('def_x', '>', 720)->get();
        return $images;
    }

    //Question 5.3
    public static function fonction53() {;
        $sand = self::has('images', '>', 4)->get();
        return $sand;
    }

    //Question 5.6
    public static function fonction56() {;
        $sand = self::whereHas('images', function($q) {
            $q->where('type', '=', 'image/jpeg')->where('taille', '>', 18000);
        })->get();
        return $sand;
    }

    //Question 5.8
    public static function fonction58() {;
        $sand = self::whereHas('images', function($q) {
            $q->where('type', '=', 'image/jpeg')->where('taille', '>', 18000);
        })->whereHas('categories', function($q) {
            $q->where('nom', '=', 'traditionnel');
        })->get();
        return $sand;
    }

    //Question 5.9
    public static function fonction59(){
        $listeTailles=self::find(7)->tailleSandwichs()->wherePivot("prix", "<", 7)->get();
        return $listeTailles;
    }

    /* PARTIE 6 */

    public static function fonction6(){
        $sand = new Sandwich;
        $sand->nom = "Sandwich delete";
        $sand->description = "Le sandwich qu'on supprime";
        $sand->type_pain = "baguette";
        $sand->save();

        $sand->delete();

        return $sand->nom." supprimé";
    }
}