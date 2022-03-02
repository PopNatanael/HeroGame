<?php
abstract Class Stats
{
    public float $hp;
    public int $strength;
    public int $defence;
    public int $speed;
    public int $luck;
    public function __construct(float $hp, int $strength, int $defence, int $speed, int $luck)
    {
        $this->hp=$hp;
        $this->strength=$strength;
        $this->defence=$defence;
        $this->speed=$speed;
        $this->luck=$luck;
    }
    abstract public function setHP(float $newHP);
    abstract public function setStrength(int $newStrength);
    abstract public function setDefence(int $newDefence);
    abstract public function setSpeed(int $newSpeed);
    abstract public function setLuck(int $newLuck);

    abstract public function getHP();
    abstract public function getStrength();
    abstract public function getDefence();
    abstract public function getSpeed();
    abstract public function getLuck();
}
