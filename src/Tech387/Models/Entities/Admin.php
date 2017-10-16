<?php

namespace Tech387\Models\Entities;

class Admin
{

    private $id;
    private $name;
    private $lastName;
    private $lastLogIn;
    private $password;
    private $image;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastLogIn($lastLogIn)
    {
        $this->lastLogIn = $lastLogIn;
    }

    public function getLastLogIn()
    {
        return $this->lastLogIn;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

}