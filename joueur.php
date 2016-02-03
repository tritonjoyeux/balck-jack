<?php
class joueur
{
    private $pseudo;
    private $taille;
    private $main;

    function __construct($joueur,$main,$valeur)
    {
        if(empty($main)) {
            $this->main = [];
        }else{
            $this->main = $main;
            $this->taille = $valeur;
        }
        $this->pseudo = $joueur;
    }

    public function ajouter($carte)
    {
        array_push($this->main, $carte);
    }

    public function getValueTot()
    {
        $taille=0;
        foreach($this->main as $carte){
            $taille+=$carte->getValue();
        }
        return $taille;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getMain()
    {
        return $this->main;
    }
}


class bank extends joueur
{

}
