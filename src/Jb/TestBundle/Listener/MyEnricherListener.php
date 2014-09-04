<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Listener;

use Broadway\Domain\Metadata;
use Broadway\EventSourcing\MetadataEnrichment\MetadataEnricherInterface;
use Symfony\Component\Security\Core\SecurityContext;

class MyEnricherListener implements MetadataEnricherInterface {
	private $securityContext;
	private $event;

	public function __construct(SecurityContext $sc){

		$this->securityContext = $sc;
	}

	public function enrich(Metadata $metadata){
		
        $data = array(
            'user' => $this->securityContext->getToken()->getUser()->getUserName()
        );
        $newMetadata = new Metadata($data);
        return $metadata->merge($newMetadata);
    }
}