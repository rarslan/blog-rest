<?php

namespace Tech387\Models\Entities;

class Auth
{

    private $name;
    private $email;
    private $image;
    private $password;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function  getPassword()
    {
        return $this->password;
    }

}