<?php

namespace catawich\models;


class Categorie extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function sandwichs(){
        return $this->belongsToMany('catawich\models\Sandwich', 'sand2cat', 'cat_id', 'sand_id');
    }

    /* PARTIE 3 */

    //Question 3.2
    public static function categorieEtSand(){
        $cat = self::with('sandwichs')->get();
        return $cat;
    }

    /* PARTIE 5 */

    //Question 5.1
    public static function fonction51(){
        $categ = self::where('nom', 'like', '%traditionnel%')->get();
        foreach ($categ as $value) {
            $sand[]=$value->sandwichs()->where("type_pain", "=", "baguette")->get();
        }
        return $sand;
    }

    //Question 5.2
    public static function fonction55(){
        $categ = self::whereHas('sandwichs', function($q) {
            $q->where('type_pain', '=', 'baguette');
        })->get();
        return $categ;
    }

    //Question 5.7
    public static function fonction57() {
        $categ = self::whereHas('sandwichs', function($a) {
            $a->whereHas('images', function($q) {
                $q->where('type', '=', 'image/jpeg')->where('taille', '>', 18000);
            });
        })->get();
        return $categ;
    }
}