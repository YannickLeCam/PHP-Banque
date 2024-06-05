<?php
require_once 'Client.php';


class Compte {
    
    private string $libellé;
    
    private int $solde;

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
    public function __construct(string $libellé,string $devise,Client $client ,int $solde =0) {
        $error_msg = [];
        if (in_array($libellé,["compte courant", "compte à vue", "compte chèque", "compte de dépôt"])) {
            $this->libellé = $libellé;
        }else {
            $error_msg[]="Le libellé \"$libellé\" ne correspond pas a ce qu'il est possible de faire ! ";
        }
        if (in_array($devise,['€','$'])) { //peut-etre trouver d'autre devise sur le net
            $this->devise = $devise;
        }else{
            $error_msg[]="La devise \"$devise\" ne correspond pas a ce qu'il est possible de faire ! ";
        }
        $this->client=$client;
        $this->client->addCompte($this);
        $this->solde = $solde;
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
    public function getSolde(): int
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
    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get the value of libellé
     *
     * @return string
     */
    public function getLibellé(): string
    {
        return $this->libellé;
    }

    /**
     * Set the value of libellé
     *
     * @param string $libellé
     *
     * @return self
     */
    public function setLibellé(string $libellé): self
    {
        $this->libellé = $libellé;

        return $this;
    }

    public function debiter(float $montant):void{
        $this->solde -= $montant;
    }

    public function crediter(float $montant):void{
        $this->solde += $montant;
    }

    public function virement(Compte $compte, float $montant){
        $this->debiter($montant);
        $compte->crediter($montant);
    }
    
    public function __toString(){
        return "$libellé de $client : $solde $devise";
    }
}
?>