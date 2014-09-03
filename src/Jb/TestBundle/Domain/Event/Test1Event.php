<?php


namespace Jb\TestBundle\Domain\Event;

use Broadway\Serializer\SerializableInterface;

class Test1Event implements SerializableInterface {
	public $texte;

	public function __construct($texte){
		$this->texte = $texte;
	}

	public static function deserialize(array $data){
		return new Test1Event($data['texte']);
	}

    /**
     * @return array
     */
    public function serialize(){
    	return array("texte"=>$this->texte);
    }
}

