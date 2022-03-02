<?php

class Battle
{
    public Hero $julien;
    public Monster $monster;

    public function __construct(Hero $julien, Monster $monster)
    {
        $this->julien = $julien;
        $this->monster = $monster;
    }

    public function displayStats()
    {
        echo '<div style="text-align:center;width:100%;">';
        echo '<div style="width: 50%;float: left;">';
        echo '<h3>Hero Stats</h3>';
        echo 'HP:'.$this->julien->getHP().'<br>';
        echo 'Strength:'.$this->julien->getStrength().'<br>';
        echo 'Defence:'.$this->julien->getDefence().'<br>';
        echo 'Speed:'.$this->julien->getSpeed().'<br>';
        echo 'Luck:'.$this->julien->getLuck().'<br>';
        echo '</div>';
        echo '<div style="width: 50%;float: left;">';
        echo '<h3>Monster Stats</h3>';
        echo 'HP:'.$this->monster->getHP().'<br>';
        echo 'Strength:'.$this->monster->getStrength().'<br>';
        echo 'Defence:'.$this->monster->getDefence().'<br>';
        echo 'Speed:'.$this->monster->getSpeed().'<br>';
        echo 'Luck:'.$this->monster->getLuck().'<br>';echo '</div>';
        echo '<br>';
        echo '</div>';
    }

    //function to determine who attacks first based on stats
    public function whoAttacksFirst()
    {
        if ($this->julien->getSpeed() < $this->monster->getSpeed()) {
            return false;
        }
        elseif ($this->julien->getSpeed() > $this->monster->getSpeed()) {
            return true;
        }
        elseif ($this->julien->getSpeed() == $this->monster->getSpeed()) {
            if ($this->julien->getLuck() > $this->monster->getLuck()) {
                return true;
            }
            elseif ($this->julien->getLuck() < $this->monster->getLuck()) {
                return false;
            }
            elseif ($this->julien->getLuck() == $this->monster->getLuck()) {
                return true;
            }
        }   
    }

    //function that runs the game
    public function startBattle()
    {
        //check who goes first
        $abilities = include 'config/newAbilities.php';
        $whoGoesFirst = $this->whoAttacksFirst();
        $stats = include 'config/config.php';
        $turn = 1;

        while ($turn <= $stats['NumberOfRounds']) {
            foreach ($abilities as $ability) {
                //random is for determining the chance to trigger an ability or if an attack is dodged
                $random = rand(1,100);
                echo '<div style="text-align:center;width:100%;"> '.'<h1>Round '.$turn.'</h1>';
                //hero attacks
                if ($whoGoesFirst == true) {
                    //check monster luck to see if attack is dodged
                    if ($random > $this->monster->getLuck()) {
                        if (ISSET($ability['Offense'])) {
                            //check if any set abilities will trigger
                            foreach ($ability['Offense'] as $offense) {
                                $random = rand(1,100);
                                if ($random <= $offense['chance']) {
                                    echo '<h2 style="color:red"> '.$offense['name'].' used</h2>';
                                    $randhp = $this->monster->getHP() - (($this->julien->getStrength() - $this->monster->getDefence()) * $offense['damage']);
                                    $display = ($this->julien->getStrength() - $this->monster->getDefence()) * $offense['damage'];
                                    break;
                                }
                                else {
                                    $randhp = $this->monster->getHP() - ($this->julien->getStrength() - $this->monster->getDefence());
                                    $display = ($this->julien->getStrength() - $this->monster->getDefence());
                                }
                            }
                        }
                        echo '<h2>Hero attacks</h2>';
                        $this->monster->setHP($randhp);
                        //winning message for Hero
                        if ($this->monster->getHP() <= 0) {
                                echo '<h2>Monster took '.$display.' damage</h2> '.'<h3>Monster HP:0</h3></br>'.'<h2>Hero WON</h2>';   
                                exit();
                            }
                            echo '<h2>Monster took '.$display.' damage</h2>';   
                            $this->displayStats();
                    }
                    //monster dodged message
                    elseif ($random <= $this->monster->getLuck()) {
                        echo '<h1>Hero Attacks '.'<h2 style="color:darkred">Monster Dodged. 0 Damage Taken</h2>';
                    }
                }
                //monster attacks
                elseif ($whoGoesFirst == false) {
                    if ($random > $this->julien->getLuck()) {
                        if (ISSET($ability['Defense'])) {
                            //check if any set abilities will trigger
                            foreach ($ability['Defense'] as $defense) {
                                $random = rand(1,100);
                                if ($random <= $defense['chance']) {
                                    echo '<h2 style="color:blue">'.$defense['name'].' Used</h2>';
                                    $randhhp = number_format($this->julien->getHP() - (($this->monster->getStrength() - $this->julien->getDefence()) / $defense['damage']), 2, '.', '');
                                    $display = number_format(($this->monster->getStrength() - $this->julien->getDefence()) / $defense['damage'], 2, '.', '');
                                    break;
                                }
                                else {
                                    $randhhp = $this->julien->getHP() - ($this->monster->getStrength() - $this->julien->getDefence());
                                    $display = ($this->monster->getStrength() - $this->julien->getDefence());
                                }
                            }
                        }
                        echo '<h2>Monster attacks</h2>';
                        $this->julien->setHP($randhhp);
                        //monster winning message
                        if ($this->julien->getHP() <= 0) {
                            echo '<h2>Hero took '.$display.' damage</h2> '.'<h3>Hero HP: 0</h3></br>'.'<h2>Monster WON</h2>';
                            exit();
                        }
                        echo '<h2>Hero took '.$display.' damage</h2>';
                        $this->displayStats();
                    }
                    //Hero dodged message
                    elseif ($random <= $this->julien->getLuck()) {
                        echo '<h1>Monster Attacks'.'<h2 style="color:darkred">Hero Dodged. 0 Damage Taken</h2>';
                    }
                }
                echo '</div>'.'<br>';
                //switch attacker every round
                if ($whoGoesFirst == true){
                    $whoGoesFirst = false;
                }
                else {
                    $whoGoesFirst = true;
                }
                $turn++;
                //check if game hasn't gone over the number of rounds set in config
                if ($turn > $stats['NumberOfRounds']) {
                    echo '<h2 style="margin-left:45%;">Game Over</h2>';
                }
            }
        }
    }
}
