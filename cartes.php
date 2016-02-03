<?php


class card
{
    private $value;
    private $face;
    private $color;

    function __construct($color, $face)
    {
        $this->face = $face;
        $this->color = $color;
        $this->value = 0;
        $this->value = $this->getValue();
    }

    public function getFace()
    {
        return $this->face;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getValue()
    {
        if (is_numeric($this->face)) {
            $this->value = $this->face;
        } else {
            $this->value = 10;
        }
        return $this->value;
    }

    public function __toString()
    {
        return $this->face . ' de ' . $this->color;
    }

}

class deck
{
    private $cards;

    public function __construct()
    {
        $this->cards = [];
        $colors = array('Coeur', 'Carreau', 'Piques', 'Trefles');
        $faces = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K");
        foreach ($colors as $color) {
            foreach ($faces as $face) {
                $this->cards[] = new card($color, $face);
            }
        }
    }

    public function melanger()
    {
        shuffle($this->cards);
        return $this;
    }

    public function tirerCarte($n = 1)
    {
        $cards = array_slice($this->cards, 0, $n);
        return $cards;
    }
}
