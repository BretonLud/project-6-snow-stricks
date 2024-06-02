<?php

namespace App\EventSubscriber;

use App\Entity\Picture;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;

readonly class PictureRemoveSubscriber
{
    
    public function __construct(
        private Filesystem $filesystem,
        private string     $picturesDirectory
    )
    {
    }
    
    public function preRemove(LifecycleEventArgs $args): void
    {
        $picture = $args->getObject();
        
        if (!$picture instanceof Picture) {
            return;
        }
        
        $filename = $picture->getFilename();
     
        $filePath = $this->picturesDirectory .'/'.$filename;
     
        if ($this->filesystem->exists($filePath)) {
            $this->filesystem->remove($filePath);
        }
        
    }
}