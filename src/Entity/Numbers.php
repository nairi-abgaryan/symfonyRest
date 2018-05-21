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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
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

    public function getUser_id() {
        return $this->user_id;
    }

    public function getHome() {
        return $this->home;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function getOffice() {
        return $this->office;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setHome($home) {
        $this->home = $home;
    }

    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    public function setOffice($office) {
        $this->office = $office;
    }
}
