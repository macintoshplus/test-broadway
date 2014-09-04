<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Command;
/**
* Second command use for update a existing aggregate.
* 
*/
class Test2Command
{
	private $texte;
	private $id;

	public function __construct($id, $texte){
		$this->texte=$texte;
		$this->id=$id;
	}

	public function getTexte(){
		return $this->texte;
	}

	public function getId(){
		return $this->id;
	}

}

