<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Listener;

use Broadway\Domain\Metadata;
use Broadway\EventSourcing\MetadataEnrichment\MetadataEnricherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MyEnricherListener implements MetadataEnricherInterface
{
    private $tokenStorage;
    private $event;

    public function __construct(TokenStorage $sc)
    {
        $this->tokenStorage = $sc;
    }

    public function enrich(Metadata $metadata)
    {
        $data = array(
            'user' => $this->tokenStorage->getToken()->getUser()->getUserName()
        );
        $newMetadata = new Metadata($data);

        return $metadata->merge($newMetadata);
    }
}
