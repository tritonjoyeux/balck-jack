<?php

require "cartes.php";

require "game.php";

require "joueur.php";

session_start();

if (!isset($_POST['jouer'])) {
    $deck = new deck();
    $bank = new bank('Bank', '', '');
    $joueur = new joueur('Mougui', '', '');

    echo "<i><b>" . $bank->getPseudo() . "</b></i> : <br>";
    for ($i = 0; $i < 2; $i++) {
        list($carte) = $deck->melanger()->tirerCarte(1);
        serialize($deck);
        $bank->ajouter($carte);
        echo $carte . "<br>";
    }

    echo '<u>Resultat : ' . $bank->getValueTot() . "</u><br><br>";

    ///////////////////////////////////////////////////////

    echo "<i><b>" . $joueur->getPseudo() . "</b></i> : <br>";
    for ($i = 0; $i < 2; $i++) {
        list($carte) = $deck->melanger()->tirerCarte(1);
        serialize($deck);
        $joueur->ajouter($carte);
        echo $carte . "<br>";
    }
    echo '<u>Resultat : ' . $joueur->getValueTot() . "</u><br><br>";

    ////////////////////////////////////////////////////////

    $game = new game();
    $game->enregistrer($joueur->getMain(), $bank->getMain(), $bank->getValueTot(), $joueur->getValueTot());
} else {
    $game = new $_SESSION['game']();
    $deck = new $_SESSION['deck']();
    $joueur = new $_SESSION['joueur']('Mougui', $_SESSION['game']->getHandPlayer(), $_SESSION['game']->getValuePlayer());
    $bank = new $_SESSION['bank']('Bank', $_SESSION['game']->getHandBank(), $_SESSION['game']->getValueBank());
    echo "<i><b>" . $bank->getPseudo() . "</b></i> : <br>";
    foreach ($bank->getMain() as $cartes) {
        echo $cartes . "<br>";
    }
    if ($bank->getValuetot() < 18) {
        list($carte) = $deck->melanger()->tirerCarte(1);
        serialize($deck);
        $bank->ajouter($carte);
        echo $carte . "<br>";
    }
    echo '<u>Resultat : ' . $bank->getValueTot() . "</u><br><br>";

    ////////////////////////////////////////////////////////

    echo "<i><b>" . $joueur->getPseudo() . "</b></i> : <br>";
    foreach ($joueur->getMain() as $cards) {
        echo $cards . "<br>";
    }
    if ($joueur->getValuetot() < 21) {
        list($carte) = $deck->melanger()->tirerCarte(1);
        serialize($deck);
        $joueur->ajouter($carte);
        echo $carte . "<br>";
    }
    echo '<u>Resultat : ' . $joueur->getValueTot() . "</u><br><br>";

    $game->enregistrer($joueur->getMain(), $bank->getMain(), $bank->getValueTot(), $joueur->getValueTot());
}
if ($bank->getValueTot() > 20 || $joueur->getValueTot() > 20) {
    if ($bank->getValueTot() < 22 && $bank->getValueTot() > $joueur->getValueTot()) {
        echo '<b>La banque Gagne</b>';
    } else if ($joueur->getValueTot() < 22 && $joueur->getValueTot() > $bank->getValueTot()) {
        echo '<b>La banque perd</b>';
    } else if ($joueur->getValueTot() == $bank->getValueTot()) {
        echo '<b>Egalite</b>';
    } else if ($bank->getValueTot() > 21 && $joueur->getValueTot() < 22) {
        echo '<b>La banque perd</b>';
    } else if ($joueur->getValueTot() > 21 && $bank->getValueTot() < 22) {
        echo '<b>La banque Gagne</b>';
    }
}
$_SESSION['game'] = $game;
$_SESSION['joueur'] = $joueur;
$_SESSION['bank'] = $bank;
$_SESSION['deck'] = $deck;

echo '<form method="post"><input type="submit" value="Jouer" name="jouer"></form>';
echo '<form method="post"><input type="submit" value="Stop" name="stop"></form>';