<?php
require_once 'Client.php';


class Compte {
    
    private string $libelle;
    
    private float $solde;

    private string $devise;

    private Client $client;

        
    /**
     * __construct
     *
     * @param  mixed $libell doit appartenir a une liste
     * @param  mixed $devise doit appartenir a une liste
     * @param  mixed $client
     * @param  mixed $solde init a 0 par défault
     * @return void
     */
    public function __construct(string $libelle,string $devise,Client $client ,float $solde =0) {
        $error_msg = [];
        if (in_array($libelle,["compte courant", "compte à vue", "compte chèque", "compte de dépôt"])) {
            $this->libelle = $libelle;
        }else {
            $error_msg[]="Le libelle \"$libelle\" ne correspond pas a ce qu'il est possible de faire ! ";
        }
        if (in_array($devise,['€','$','£'])) { //peut-etre trouver d'autre devise sur le net
            $this->devise = $devise;
        }else{
            $error_msg[]="La devise \"$devise\" ne correspond pas a ce qu'il est possible de faire ! ";
        }
        $this->client=$client;
        $this->client->addCompte($this);
        $this->solde = $solde;
        if (count($error_msg)>0) {
            throw new Exception($error_msg, 1);
        }
    }

    /**
     * Get the value of client
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @param Client $client
     *
     * @return self
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get the value of devise
     *
     * @return string
     */
    public function getDevise(): string
    {
        return $this->devise;
    }

    /**
     * Set the value of devise
     *
     * @param string $devise
     *
     * @return self
     */
    public function setDevise(string $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get the value of solde
     *
     * @return int
     */
    public function getSolde(): float
    {
        return $this->solde;
    }

    /**
     * Set the value of solde
     *
     * @param int $solde
     *
     * @return self
     */
    public function setSolde(float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get the value of libelle
     *
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @param string $libelle
     *
     * @return self
     */
    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
    
    /**
     * convertisseur est convertisseur primaire car les deux sens ne sont pris en compte dans les transactions ! ! ! ! !
     *
     * @param  string $devise
     * @return void
     */
    public function convertisseur(string $devise){
        
        switch ($devise) {
            case '€':
                return 0.09;
            case '£':
                return 0.28;
            default://$
                return 0;
        }
    }
    public function debiter(float $montant):void{
        $this->solde -= $montant;
    }

    public function crediter(float $montant):void{
        $this->solde += $montant;
    }

    public function virement(Compte $compte, float $montant):void{
        $this->debiter($montant);
        $compte->crediter(round($montant*(1+ ( $this->convertisseur($this->devise) - $this->convertisseur($compte->getDevise()) )), 2) );
    }
    
    public function __toString(){
        return "$this->libelle : $this->solde $this->devise";
    }

    public function infoClient(){
        return "Le détenteur du compte est $this->client et il a " . $this->client->age()." ans <br> "."Il possède égallement les comptes : <br>"  . $this->client->printComptes();
    }
}
?>