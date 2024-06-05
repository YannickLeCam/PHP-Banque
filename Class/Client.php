<?php
require_once 'Compte.php';

class Client {

    private string $nom;

    private string $prenom;

    private DateTime $naissance;

    private string $ville;

    private array $comptes=[];

    public function __construct(string $nom,string $prenom,DateTime $naissance,string $ville) {
        $this->nom = strtoupper($nom); //pour un affichage plus conventionnel et propre !
        $this->prenom = $prenom;
        $this->naissance = $naissance;
        $this->ville = $ville;
    }

    public function getNom():string{
        return $this->nom;
    }
    public function setNom(string $nom){
        $this->nom = $nom;
    }

    public function getPrenom():string{
        return $this->prenom;
    }
    public function setprenom(string $prenom){
        $this->prenom = $prenom;
    }

    public function getNaissance():DateTime{
        return $this->$naissance;
    }
    public function setNaissance(DateTime $naissance):void{
        $this->$naissance=$naissance;
    }

    public function getVille():string{
        return $this->ville;
    }
    public function setVille(string $ville){
        $this->ville = $ville;
    }

        
    /**
     * getComptes
     *
     * @return array[Compte]
     */
    public function getComptes():array {
        return $this->$comptes;
    }
    //J'ai volontairement pas mit de setter a getComptes car il existe addCompte

    public function addCompte(Compte $compte){
        //verifier que $compte est bien de la classe compte jsp si on peut duper le truc de base
        if (in_array($compte,$this->comptes)) {
            throw new Exception("Error addCompte is already here", 1);
            return;
        }else {
            if ($compte->getClient() == $this) {
                $this->comptes[] = $compte;
            }else {
                throw new Exception("Error addCompte the Compte owner isn't right !", 1);
                return;
            }
        }
    }

    public function age(){
        $age=$this->naissance->diff(new DateTime(),true);
        return $age->y;
    }

    public function printComptes():string{
        $retour="";
        foreach ($this->comptes as $compte) {
            $retour.="<li>$compte</li>";
        }
        return $retour;
    }

    public function information(){
        return "<h3>$this (". $this->age() ." ans)</h3>" . $this->printComptes();
         $retour;
    }

    public function __toString(){
        return "$this->nom $this->prenom";
    }
}
?>