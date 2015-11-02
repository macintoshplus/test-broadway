<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Event;

use Broadway\Serializer\SerializableInterface;

class Test1Event implements SerializableInterface
{
    private $texte;

    private $id;

    public function __construct($id, $texte)
    {
        $this->id = $id;
        $this->texte = $texte;
    }

    public static function deserialize(array $data)
    {
        return new self($data['id'], $data['texte']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array("id"=>$this->id, "texte"=>$this->texte);
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the value of texte.
     *
     * @return mixed
     */
    public function getTexte()
    {
        return $this->texte;
    }
}
