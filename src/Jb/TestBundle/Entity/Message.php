<?php

namespace Jb\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 */
class Message
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $texte;

    /**
     * @var integer
     */
    private $version;


    /**
     * Set id
     *
     * @return string 
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return Message
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set Version
     *
     * @param string $version
     * @return Message
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get Version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }
}
