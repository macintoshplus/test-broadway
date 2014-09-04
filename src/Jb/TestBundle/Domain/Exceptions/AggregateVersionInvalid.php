<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Exceptions;

use Exception;

class AggregateVersionInvalid extends Exception {
	public function __construct($message = null){
		parent::__construct((null === $message)? 'The aggregate version in memory have invalid version':$message);
	}
}