<?php
require_once 'Class/Client.php';
require_once 'Class/Compte.php';

?>


<h1>Exercice Banque</h1>

<?php
$cli1 = new Client("Le Cam","Yannick" , new DateTime("1996-11-08") , "Rennes");

var_dump($cli1);
echo "Je suis un echo de cli1 :  $cli1 et il a $cli1->age";

?>