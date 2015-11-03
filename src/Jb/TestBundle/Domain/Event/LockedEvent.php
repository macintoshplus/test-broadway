<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Event;

use Broadway\Serializer\SerializableInterface;

class LockedEvent implements EventInterface, SerializableInterface
{
    public function __construct()
    {
    }

    public static function deserialize(array $data)
    {
        return new self();
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array();
    }
}
