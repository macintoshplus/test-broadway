<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Event;

use Broadway\Serializer\SerializableInterface;

class Test1Event implements SerializableInterface {
	public $texte;
	public $id;

	public function __construct($id, $texte){
		$this->texte = $texte;
		$this->id=$id;
	}

	public static function deserialize(array $data){
		return new Test1Event($data['id'],$data['texte']);
	}

    /**
     * @return array
     */
    public function serialize(){
    	return array("texte"=>$this->texte, "id"=>$this->id);
    }
}

