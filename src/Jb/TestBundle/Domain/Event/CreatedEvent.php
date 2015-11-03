<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Event;

use Broadway\Serializer\SerializableInterface;

class CreatedEvent implements EventInterface, SerializableInterface
{
    private $text;
    private $id;

    public function __construct($id, $text)
    {
        $this->text = $text;
        $this->id=$id;
    }

    public static function deserialize(array $data)
    {
        return new self($data['id'], $data['text']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array("text"=>$this->text, "id"=>$this->id);
    }

    /**
     * Gets the value of text.
     *
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
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
}
