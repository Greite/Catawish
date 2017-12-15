<?php

require __DIR__.'/vendor/autoload.php';

use catawich\models\Sandwich;
use catawich\models\Categorie;
use catawich\models\Image;

//Connexion

$config = [
       'driver'    => 'mysql',
       'host'      => 'db',
       'database'  => 'cata',
       'username'  => 'root',
       'password'  => 'root123',
       'charset'   => 'utf8',
       'collation' => 'utf8_unicode_ci',
       'prefix'    => '' ];

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $config );
$db->setAsGlobal();
$db->bootEloquent();

/* PARTIE 1 */

//Question 1.1

$listsand = Sandwich::listSandwich(); 
echo '<h2>1.1 : Liste de sandwichs</h2>';
foreach ($listsand as $key => $value) {
	echo "<p>".$key." => ".$value."</p>";
}

//Question 1.2

$listsand2 = Sandwich::listSandwichOrderBy(); 
echo '<h2>1.2 : Liste de sandwichs triés</h2>';
foreach ($listsand2 as $key => $value) {
	echo "<p>".$key." => ".$value."</p>";
}

//Question 1.3

echo '<h2>1.3 : Sandwich n°42</h2>';
try {
       $sand42 = Sandwich::sandwich42();
       echo "<p>".$sand42."</p>";
} catch (Exception $e) {
       echo "Erreur: ".$e->getMessage()."\n";
}

//Question 1.4

echo '<h2>1.4 : Liste de sandwichs contenant baguette</h2>';
$listsand3 = Sandwich::listTypePainBaguette(); 
foreach ($listsand3 as $key => $value) {
       echo "<p>".$key." => ".$value."</p>";
}

//Question 1.5

echo "<h2>1.5 : Insertion sandwich dans la base</h2>";
//echo Sandwich::newSandwich("le campagnard", "un sandwich de paysan : pomme de terre, lard, bacon, oeuf, salade", "baguette campagne");
echo "On évite de le faire 1000 fois";


/* PARTIE 2 */

//Question 2.1

echo '<h2>2.1 : Liste du sandwich n°4 et de ses images</h2>';
$sand4img = Sandwich::sand4img();
foreach ($sand4img as $key => $value) {
  echo "<p>".$key." => ".$value."</p>";
}

//Question 2.2

echo '<h2>2.2 : Liste de tous les sandwichs et de leurs images</h2>';
$sands = Sandwich::allsandimg();
foreach ($sands as $key => $value) {
  echo "<p>".$key." => ".$value."</p>";
}

//Question 2.3

echo '<h2>2.3 : Liste de toutes les images et de leurs sandwichs</h2>';
$imgs = Image::allimgsand();
foreach ($imgs as $key => $value) {
  echo "<ul>";
  echo "<li>Image ID = ".$value->id."</li>";
  echo "<li>Titre de l'image = ".$value->titre."</li>";
  echo "<li>Nom de sandwich = ".$value->sandwich->nom."</li>";
  echo "<li>Type de pain = ".$value->sandwich->type_pain."</li>";
  echo "</ul>";
}

//Question 2.4
echo "<h2>2.4 : Insertion 3 images du sandwich ajouté en 1.5 dans la base</h2>";
//echo Image::insertionImage("kebab_0", 1920, 1080, 19200, "img_456fdsffd4s56", 11)."<br>";
//echo Image::insertionImage("kebab_1", 1920, 1080, 19201, "img_7892fdsgfd132", 11)."<br>";
//$id_image3 = Image::insertionImage("kebab_2", 1920, 1080, 19202, "img_4561gsfdgfd12", 11)."<br>";
//echo $id_image3;
echo "On évite de le faire 1000 fois";

//Question 2.5
echo "<h2>2.5 : On change le sandwich associé de la 3ème image créer</h2>";
//echo Image::modifIdImage3($id_image3);

/* PARITE 3 */

//Question 3.1
echo "<h2>3.1 : Catégories du sandwich 5</h2>";
$sand = Sandwich::categSand5();
echo $sand->nom."<br>";
echo $sand->description."<br>";
echo $sand->type_pain."<br>";
echo "<h3>Categories associé : </h3>";
foreach ($sand->categories as $v){
    echo $v->nom."<br>";
}

//Question 3.2
echo "<h2>3.2 : Catégories et sandwich associés</h2>";
$cat = Categorie::categorieEtSand();
foreach ($cat as $value) {
    echo "categorie :".$value->nom." a pour sandwichs ";
    foreach($value->sandwichs as $v){
        echo $v->nom.",";
    }
    echo "<br>";
}


//Question 3.3
echo "<h2>3.3 : Sandwich pain baguette -> categorie</h2>";
$sand = Sandwich::fonction33();
foreach ($sand as $value){
    echo "<h3>".$value->nom."</h3>";
    echo "<h4>Categories associé : </h4>";
    foreach ($value->categories as $v){
        echo $v->nom."<br>";
    }
    $images = Image::where('s_id', '=', $value->id)->get();
    echo "<h4>Images associé : </h4>";
    foreach ($images as $v){
        echo $v->titre."<br>";
    }
    echo "<br>";
}

//Question 3.4
echo "<h2>3.4 : Sandwich créer au 1.5 avec les catégories 1,3</h2>";
//Sandwich::fonction34(11, 1);
//Sandwich::fonction34(11, 3);
echo "On évite de le faire 1000 fois";

/* PARTIE 4 */

//Question 4.1
echo "<h2>4.1 Taille du sandwich 5</h2>";
$tailleSand = Sandwich::tailleSand5();
echo $tailleSand->nom."<br>";
echo $tailleSand->description."<br>";
echo $tailleSand->type_pain."<br>";
echo "<h3>tailles associées : </h3>";
foreach ($tailleSand->tailleSandwichs as $v){
    echo $v->nom."<br>";
}

//Question 4.2
echo "<h2>4.2 Taille du sandwich 5 avec les prix</h2>";
$tailleSand = Sandwich::tailleSand5();
echo $tailleSand->nom."<br>";
echo $tailleSand->description."<br>";
echo $tailleSand->type_pain."<br>";
echo "<h3>tailles associées : </h3>";
foreach ($tailleSand->tailleSandwichs as $v){
    echo $v->nom." au prix de ".$v->pivot->prix."<br>";
}

//Question 4.3
echo "<h2>4.3 : Sandwich créer au 1.5 avec toutes les tailles plus prix</h2>";
//Sandwich::fonction43(11, 1, 7);
//Sandwich::fonction43(11, 2, 8);
//Sandwich::fonction43(11, 3, 9);
//Sandwich::fonction43(11, 4, 10);
echo "On évite de le faire 1000 fois";

/* PARTIE 5 */

//Question 5.1
echo '<h2>5.1 : Pour la catégorie dont le nom contient \'traditionnel\', lister les sandwichs dont le type_pain 
contient \'baguette\'</h2>';
$baguettes = Categorie::fonction51();
foreach ($baguettes as $value) {
    echo "<p>$value</p>";
}

//Question 5.2
echo '<h2>5.2 : liste des images du sandwich n°5 dont def_x est supérieur à 720</h2>';
$sand5img = Sandwich::fonction52();
foreach ($sand5img as $value) {
    echo "<p>".$value."</p>";
}

//Question 5.3
echo '<h2>5.3 : lister les sandwichs qui ont plus de 4 images associées</h2>';
$sand = Sandwich::fonction53();
foreach ($sand as $value) {
    echo "<p>".$value."</p>";
}

//Question 5.5
echo '<h2>5.5 : lister les catégories qui contiennent des sandwichs dont le type de pain est \'baguette\'</h2>';
$categ = Categorie::fonction55();
foreach ($categ as $value) {
    echo "<p>".$value."</p>";
}

//Question 5.6
echo '<h2>5.6 : lister les sandwichs qui possèdent des images de types \'image/jpeg\' de taille > 18000</h2>';
$sand = Sandwich::fonction56();
foreach ($sand as $value) {
    echo "<p>".$value."</p>";
}

//Question 5.7
echo '<h2>5.7 : catégories qui possèdent des images de types \'image/jpeg\' de taille > 18000</h2>';
$categ = Categorie::fonction57();
foreach ($categ as $value) {
    echo "<p>".$value."</p>";
}

//Question 5.8
echo '<h2>5.8 : lister les sandwichs qui possèdent des images de types \'image/jpeg\' de taille > 18000 et qui 
sont de catégorie \'traditionnel\'</h2>';
$sand = Sandwich::fonction58();
foreach ($sand as $value) {
    echo "<p>".$value."</p>";
}

//Question 5.9
echo '<h2>5.9 : pour le sandwich d\'ID 7, lister les tailles pour lequel il est disponible avec un prix < 7.0</h2>';
$listeTaille = Sandwich::fonction59();
foreach($listeTaille as $value){
    echo $value->nom."<br>";
}

/* PARTIE 6 */

//Question 6
echo '<h2>6 : Rendez logique la suppression d\'objets sandwich. Vérifier dans la base qu\'un delete ne supprime pas
la ligne</h2>';
echo Sandwich::fonction6();