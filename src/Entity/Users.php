<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $fname;

    /**
     * @ORM\Column(type="string")
     */
    private $lname;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    public function getId()
    {
        return $this->id;
    }
}
