<?php
require_once 'Class/Client.php';
require_once 'Class/Compte.php';

?>


<h1>Exercice Banque</h1>

<?php
$cli1 = new Client("Le Cam","Yannick" , new DateTime("1996-11-08") , "Rennes");
$cli2 = new Client("Rudolf","Mathias" , new DateTime("1994-12-29") , "Strasbourg");

$compte1=new Compte("compte courant","$" , $cli1);//compte de Yannick 1er
$compte2=new Compte("compte courant","€" , $cli1 , 200.56);//compte de Yannick 2eme
$compte3 = new Compte("compte chèque","€" , $cli1 , 584.66);//compte de Yannick 3eme
$compte4 = new Compte("compte courant","€",$cli2,6740.20); // compte de Mathias



echo $cli1->information();
echo $cli2->information();
$compte4->virement($compte1,250);
echo "virement de Mathias sur le compte de Yannick de 250$ mais Yannick son compte est en € donc la valeur est precise en compte lors du virement";
echo $cli1->information();
echo $cli2->information();

echo $compte4->infoClient();
echo "Je suis un echo de cli1 :  $cli1 et il a " . $cli1->age() ."ans";

?>