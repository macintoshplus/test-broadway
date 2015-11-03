<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Command;
/**
* First command use for make a new aggregate.
*
*/
class CreateCommand
{
    private $text;

    private $id;

    public function __construct($id, $text)
    {
        $this->text=$text;
        $this->id = $id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getId()
    {
        return $this->id;
    }
}
