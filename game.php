<?php

class game
{
    private $value_bank;
    private $card_bank;
    private $value_joueur;
    private $card_joueur;

    function __construct()
    {
        $this->card_bank = [];
        $this->card_joueur = [];
    }

    public function enregistrer($main_joueur, $main_bank, $valeur_bank, $valeur_joueur)
    {
        $this->card_joueur = $main_joueur;
        $this->card_bank = $main_bank;
        $this->value_bank = $valeur_bank;
        $this->value_joueur = $valeur_joueur;
    }

    public function getHandPlayer()
    {
        return $this->card_joueur;
    }

    public function getHandBank()
    {
        return $this->card_bank;
    }

    public function getValuePlayer()
    {
        return $this->value_joueur;
    }

    public function getValueBank()
    {
        return $this->value_bank;
    }
}