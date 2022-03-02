<?php
// include 'src.php';
Class Monster extends Stats 
{
    // public function __construct(int $hp, int $strength, int $defence, int $speed, int $luck)
    // {
    //     parent::__construct($hp,$strength,$defence,$speed,$luck);
    // }
    //set monster stats
    public function setHP(float $newHP)
    {
        $this->hp=$newHP;
    }
    public function setStrength(int $newStrength)
    {
        $this->strength=$newStrength;
    }
    public function setDefence(int $newDefence)
    {
        $this->defence=$newDefence;
    }
    public function setSpeed(int $newSpeed)
    {
        $this->speed=$newSpeed;
    }
    public function setLuck(int $newLuck)
    {
        $this->luck=$newLuck;
    }
    public function setAllStats(float $newHP, int $newStrength, int $newDefence, int $newSpeed, int $newLuck)
    {
        $this->hp=$newHP;
        $this->strength=$newStrength;
        $this->defence=$newDefence;
        $this->speed=$newSpeed;
        $this->luck=$newLuck;
    }

    //get monster stats
    public function getHP():float
    {
        return $this->hp;
    }
    public function getStrength():int
    {
        return $this->strength;
    }
    public function getDefence():int
    {
        return $this->defence;
    }
    public function getSpeed():int
    {
        return $this->speed;
    }
    public function getLuck():int
    {
        return $this->luck;
    }
}
