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
class Test1Command
{
	private $texte;

	private $id;

	public function __construct($id, $texte){
		$this->texte=$texte;
		$this->id = $id;
	}

	public function getTexte(){
		return $this->texte;
	}

	public function getId(){
		return $this->id;
	}

}

