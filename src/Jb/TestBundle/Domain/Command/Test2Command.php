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
class Test2Command extends Test1Command
{
	private $version;

	public function __construct($id, $texte, $version){
		parent::__construct($id, $texte);
		$this->version = $version;
	}

	public function getVersion(){
		return $this->version;
	}

}

