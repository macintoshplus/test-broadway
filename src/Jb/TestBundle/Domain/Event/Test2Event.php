<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Event;

use Broadway\Serializer\SerializableInterface;

class Test2Event implements SerializableInterface
{
    public $texte;

    public function __construct($texte)
    {
        $this->texte = $texte;
    }

    public static function deserialize(array $data)
    {
        return new self($data['texte']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array("texte"=>$this->texte);
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
