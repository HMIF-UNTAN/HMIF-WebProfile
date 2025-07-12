<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Storage;

class GoogleDriveService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        $absolutePath = config('services.google.drive_credentials_path');
        $this->client->setAuthConfig($absolutePath);
        $this->client->addScope(Google_Service_Drive::DRIVE);
        $this->service = new Google_Service_Drive($this->client);
    }

    public function setPublicPermission($fileId)
    {
        $permission = new \Google_Service_Drive_Permission([
            'type' => 'anyone',
            'role' => 'reader',
        ]);

        $this->service->permissions->create($fileId, $permission);
    }

    public function upload($file, $name, $folderId)
    {
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $name,
            'parents' => [$folderId],
        ]);

        $content = file_get_contents($file->getRealPath());

        $uploadedFile = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $file->getMimeType(),
            'uploadType' => 'multipart',
            'fields' => 'id, name',
        ]);
        $this->setPublicPermission($uploadedFile->id);

        return $uploadedFile;
    }

    public function createFolder($folderName)
    {
        $parentId = env('GOOGLE_DRIVE_FOLDER_ID');

        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [$parentId],
        ]);

        $folder = $this->service->files->create($fileMetadata, [
            'fields' => 'id',
        ]);

        return $folder->id;
    }

    public function deleteFolder($folderId)
    {
        try {
            $this->service->files->delete($folderId);
        } catch (\Exception $e) {
            logger()->error('Gagal menghapus folder: ' . $e->getMessage());
        }
    }

    public function listFilesInFolder($folderId)
    {
        $query = "'$folderId' in parents and trashed = false";
        $optParams = [
            'q' => $query,
            'fields' => 'files(id, name, webViewLink, mimeType)',
        ];

        $results = $this->service->files->listFiles($optParams);

        $files = [];
        foreach ($results->getFiles() as $file) {
            $files[] = [
                'id' => $file->getId(),
                'name' => $file->getName(),
                'webViewLink' => $file->getWebViewLink(),
                'previewUrl' => "https://drive.google.com/file/d/{$file->getId()}/preview",
            ];
        }

        return $files;
    }

    public function getFilesInFolder($folderId)
    {
        $response = $this->service->files->listFiles([
            'q' => "'$folderId' in parents and trashed = false",
            'fields' => 'files(id, name, thumbnailLink, webViewLink)',
        ]);

        $files = [];

        foreach ($response->getFiles() as $file) {
            $files[] = [
                'name' => $file->getName(),
                'thumbnailLink' => $file->getThumbnailLink(),
                'webViewLink' => $file->getWebViewLink(),
                'previewUrl' => "https://drive.google.com/file/d/{$file->getId()}/preview",
            ];
        }

        return $files;
    }

    public function deleteFile($fileId)
    {
        try {
            $this->service->files->delete($fileId);
            return true;
        } catch (\Exception $e) {
            logger()->error('Gagal menghapus file: ' . $e->getMessage());
            return false;
        }
    }

    public function listAllGaleriFolders()
    {
        $parentId = env('GOOGLE_DRIVE_FOLDER_ID'); // folder root galeri
        $query = "'{$parentId}' in parents and mimeType = 'application/vnd.google-apps.folder' and trashed = false";
    
        $results = $this->service->files->listFiles([
            'q' => $query,
            'fields' => 'files(id, name)',
        ]);
    
        return collect($results->getFiles());
    }
    

    public function folderExists($folderId)
    {
        try {
            $folder = $this->service->files->get($folderId, ['fields' => 'id']);
            return isset($folder['id']);
        } catch (\Exception $e) {
            return false;
        }
    }
}
