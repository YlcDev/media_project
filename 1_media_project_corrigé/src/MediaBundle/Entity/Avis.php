<?php

namespace MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 */
class Avis
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $commentaire;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Avis
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Avis
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    /**
     * @var \MediaBundle\Entity\Musique
     */
    private $musiques;


    /**
     * Set musiques
     *
     * @param \MediaBundle\Entity\Musique $musiques
     *
     * @return Avis
     */
    public function setMusiques(\MediaBundle\Entity\Musique $musiques = null)
    {
        $this->musiques = $musiques;

        return $this;
    }

    /**
     * Get musiques
     *
     * @return \MediaBundle\Entity\Musique
     */
    public function getMusiques()
    {
        return $this->musiques;
    }
}
