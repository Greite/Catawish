<?php
/**
 * Created by PhpStorm.
 * User: Gauthier
 * Date: 06/12/17
 * Time: 10:47
 */

namespace catawich\models;


class Categorie extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function sandwichs(){
        return $this->belongsToMany('catawich\models\Sandwich', 'sand2cat', 'cat_id', 'sand_id');
    }

    //3.2
    public static function categorieEtSand(){
        $cat = self::with('sandwichs')->get();
        return $cat;
    }

    //5.1
    public static function question5_1(){
        $categ = self::where('nom', 'like', '%traditionnel%')->get();
        foreach ($categ as $value) {
            $sand[]=$value->sandwichs()->where("type_pain", "=", "baguette")->get();
        }
        return $sand;
    }

    //5.2
    public static function question5_5(){
        $categ = self::whereHas('sandwichs', function($q) {
            $q->where('type_pain', '=', 'baguette');
        })->get();
        return $categ;
    }
}