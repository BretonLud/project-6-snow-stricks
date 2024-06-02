<?php

namespace App\Service;

use App\Entity\Picture;
use App\Entity\Tricks;
use Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

readonly class PicturesUploaderService
{
    public function __construct(
        private string           $picturesDirectory,
        private SluggerInterface $slugger,
        private Filesystem $filesystem,
    ){
    }
    
    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
        
        try {
            $file->move($this->picturesDirectory, $fileName);
        } catch (FileException $e) {
            throw new UploadException($e->getMessage());
        }
        
        return $fileName;
    }
    
    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
    
    /**
     * @throws Exception
     */
    public function setPictures(Tricks $tricks, bool $edit = false): void
    {
        if ($tricks->getPictures()->isEmpty()) {
            return;
        }
        
        $uploadedPictures = $tricks->getPictures();
        foreach ($uploadedPictures as $uploadedPicture) {
            if (!$uploadedPicture->getFile() instanceof UploadedFile && $uploadedPicture->getId() === null) {
                $tricks->removePicture($uploadedPicture);
            }
            else {
                $this->checkPicture($edit, $uploadedPicture);
            }
        }
    }
    
    /**
     * @throws Exception
     */
    private function checkPicture(bool $edit, Picture $picture): void
    {
        if (!$picture->getFile() instanceof UploadedFile) {
            return;
        }
        
        if ($picture->getFilename() and $edit)
        {
            $filePath = $this->picturesDirectory .'/'.$picture->getFilename();
            
            if ($this->filesystem->exists($filePath)){
                $this->filesystem->remove($filePath);
            }
            
            $picture->setFilename($this->upload($picture->getFile()));
        }
        
        if (!$edit || $picture->getFile() && !$picture->getFilename()) {
            $picture->setFilename($this->upload($picture->getFile()));
        }
    }
}