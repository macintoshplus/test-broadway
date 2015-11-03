<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Event;

use Broadway\Serializer\SerializableInterface;

class TextUpdatedEvent implements EventInterface, SerializableInterface
{
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public static function deserialize(array $data)
    {
        return new self($data['text']);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array("text"=>$this->text);
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
}
