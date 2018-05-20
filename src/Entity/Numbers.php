<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NumbersRepository")
 */
class Numbers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string")
     */
    private $home;

    /**
     * @ORM\Column(type="string")
     */
    private $mobile;

    /**
     * @ORM\Column(type="string")
     */
    private $office;

    public function getId()
    {
        return $this->id;
    }
}
