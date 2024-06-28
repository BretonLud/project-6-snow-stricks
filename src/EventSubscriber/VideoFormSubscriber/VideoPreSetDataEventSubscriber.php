<?php

namespace App\EventSubscriber\VideoFormSubscriber;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\Video;
use Symfony\Component\Form\FormInterface;

class VideoPreSetDataEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [FormEvents::POST_SET_DATA => 'onPostSetData'];
    }
    
    public function onPostSetData(FormEvent $event): void
    {
        $video = $event->getData();
        $form = $event->getForm();
        
        $this->setVideoUrl($form, $video);
    }
    private function setVideoUrl(FormInterface $form, ?Video $video): void
    {
        if (!$video instanceof Video) {
            return;
        }
        
        $videoHost = $video->getVideoHost();
        $videoId = $video->getVideoId();
        
        $url = match ($videoHost) {
            'youtube' => 'https://www.youtube.com/watch?v=' . $videoId,
            'vimeo' => 'https://vimeo.com/' . $videoId,
            'dailymotion' => 'https://www.dailymotion.com/video/' . $videoId,
            default => throw new \InvalidArgumentException('Unsupported video host: ' . $videoHost),
        };
        
        $form->get('videoId')->setData($url);
    }
}
