<?php
abstract class Animal{
    abstract public function eat();
    abstract public function makesound();
}
class Dog extends Animal{
    public function eat(){
        echo "Dog is eating <br>";
    }
    public function makesound(){
        echo "Dog is barking <br>";
    }
}
class Cat extends Animal{
    public function eat(){
        echo "Cat is eating <br>";
    }
    public function makesound(){
        echo "Cat is meowing <br>";
    }
}
class Bird extends Animal{
    public function eat(){
        echo "Bird is eating <br>";
    }
    public function makesound(){
        echo "Bird is chirping <br>";
    }
}

$dog = new Dog();
$dog -> eat();
$dog -> makesound();

$cat = new Cat();
$cat -> eat();
$cat -> makesound();

$bird = new Bird();
$bird -> eat();
$bird -> makesound();
?>