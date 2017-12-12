<?php

require __DIR__.'/vendor/autoload.php';

use catawich\models\Sandwich as Sandwich;
use catawich\models\Image as Image;

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

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

echo "<h1>Partie 1</h1>";
//1.1
echo "<h2>Listes de sandwichs</h2>";
$listsand = Sandwich::listSandwich();
foreach ($listsand as $key => $value) {
	echo "<p>".$key." => ".$value."</p>";
}

//1.2
echo "<h2>Listes de sandwich triés</h2>";
$listsandorder = Sandwich::listSandwichOrder();
foreach ($listsandorder as $key => $value) {
	echo "<p>".$key." => ".$value."</p>";
}

//1.3
echo "<h2>Sandwich 42</h2>";
try {
	$sand42 = Sandwich::sand42();
	echo $sand42;
	
} catch (Exception $e) {
	echo "Exception reçue : ".$e->getMessage()."\n";
}

//1.4
echo "<h2>Tous les sandwich avec le type_pain contient baguette</h2>";
$painbaguette = Sandwich::listTypePainBaguette();
foreach ($painbaguette as $key => $value) {
	echo "<p>".$key." => ".$value."</p>";
}

//1.5
echo "<h2>Insertion sandwich dans la base</h2>";
//echo Sandwich::insertionSandwich("le campagnard", "un sandwich de paysan : pomme de terre, lard, bacon, oeuf, salade", "baguette campagne");
echo "On évite de le faire 1000 fois";

echo "<h1>Partie 2</h1>";
//2.1
echo "<h2>Sandwich 4 plus ses images</h2>";
$sand4image = Sandwich::sand4Img();
foreach ($sand4image as $key => $value) {
	echo "<p>".$key." => ".$value."</p>";
}

//2.2
echo "<h2>Liste sandwich plus leurs images</h2>";
$listsandimage = Sandwich::listSandImg();
foreach ($listsandimage as $key => $value) {
	echo "<p>".$key." => ".$value."</p>";
}

//2.3
echo "<h2>Liste images plus leurs sandwich</h2>";
$listimagesand = Image::listImgSand();
foreach ($listimagesand as $key => $value) {
	echo "<ul>";
	echo "<li>Image ID = ".$value->id."</li>";
	echo "<li>Titre de l'image = ".$value->titre."</li>";
	echo "<li>Nom de sandwich = ".$value->sandwich->nom."</li>";
	echo "<li>Type de pain = ".$value->sandwich->type_pain."</li>";
	echo "</ul>";
}

//2.4
echo "<h2>Insertion 3 images du sandwich ajouter en 1.5 dans la base</h2>";
//echo Image::insertionImage("campagnard_0", 1920, 1080, 19200, "img_456fdsffd4s56", 14)."<br>";
//echo Image::insertionImage("campagnard_1", 1920, 1080, 19201, "img_7892fdsgfd132", 14)."<br>";
//echo Image::insertionImage("campagnard_2", 1920, 1080, 19202, "img_4561gsfdgfd12", 14)."<br>";
echo "On évite de le faire 1000 fois";

//2.5
echo "<h2>On change le sandwich associé de la 3ème image créer</h2>";
echo Image::modifIdImage3();

//3.1
echo "<h2>Catégories du sandwish 5</h2>";
$sand = Sandwich::categSand5();
foreach ($sand->categorie as $cat){
    echo $cat->pivot->nom;
}