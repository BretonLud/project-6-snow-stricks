<?php

namespace App\EventSubscriber\VideoFormSubscriber;

use App\Entity\Video;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class VideoSubmitEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            formEvents::SUBMIT => 'onSubmitClass'
        ];
    }
    
    public function onSubmitClass(FormEvent $event): void
    {
        $form = $event->getForm();
        $data = $event->getData();
        
        $this->setVideoId($form, $data);
    }
    
    private function setVideoId(FormInterface $form, Video $video): void
    {
        $url = $video->getVideoId();
        
        $videoHost = $video->getVideoHost();
        
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $form['videoId']->addError(new FormError('Invalid URL'));
            return;
        }
        
        switch ($videoHost) {
            case 'youtube':
                if (!preg_match('~^https?://(?:www\.)?youtube\.com/watch\?v=([\w-]*)~i', $url, $matches)) {
                    $form['videoId']->addError(new FormError('Invalid YouTube URL. The URL should be in the format: https://www.youtube.com/watch?v=[videoId]'));
                    return;
                }
                
                $videoId = $matches[1];
                break;
            case 'vimeo':
                if (!preg_match('~^https?://(?:www\.)?vimeo\.com/([\w-/]*)~i', $url, $matches)) {
                    $form['videoId']->addError(new FormError('Invalid Vimeo URL. The URL should be in the format: https://www.vimeo.com/[videoId]'));
                    return;
                }
                
                $videoId = $matches[1];
                break;
            case 'dailymotion':
                if (!preg_match('~^https?://(?:www\.)?dailymotion\.com/video/([\w-]*)~i', $url, $matches)) {
                    $form['videoId']->addError(new FormError('Invalid Dailymotion URL. The URL should be in the format: https://www.dailymotion.com/video/[videoId]'));
                    return;
                }
                
                $videoId = $matches[1];
                break;
            default:
                $form['videoId']->addError(new FormError('Unsupported video host. Please use YouTube, Vimeo, or Dailymotion.'));
                return;
        }
        
        $video->setVideoId($videoId);
    }
}