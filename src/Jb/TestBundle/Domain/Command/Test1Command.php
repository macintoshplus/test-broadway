<?php

namespace Jb\TestBundle\Domain\Command;

class Test1Command
{
	private $texte;

	public function __construct($texte){
		$this->texte=$texte;
	}

	public function getTexte(){
		return $this->texte;
	}

}

