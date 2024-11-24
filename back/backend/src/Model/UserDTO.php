<?php

namespace App\Model;


use Doctrine\Common\Collections\Collection;

class UserDTO
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public string $birthdate,
        public string $phone,
        public string $email,
        public array $experience
    )
    {

    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getExperience(): array
    {
        return $this->experience;
    }




}