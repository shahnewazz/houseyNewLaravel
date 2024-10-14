<?php

use Carbon\Carbon;

// store media
if(!function_exists('storeMedia')) {
    function storeMedia($file, string $path = '', string $disk = 'public', $random = true) {

        $fileName = generateUniqueFileName($file, $random);

       try {
            $filePath = $file->storeAs($path, $fileName, $disk);
            return $filePath;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

// update media
if(!function_exists('updateMedia')) {
    function updateMedia($newFile, ?string $oldFilePath, string $path = '', string $disk = 'public', $random = true) {


        try {
            if ($oldFilePath && Storage::disk($disk)->exists($oldFilePath)) {
                Storage::disk($disk)->delete($oldFilePath);
            }

            $filePath = storeMedia($newFile, $path, $disk, $random);

            return $filePath;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

// delete media
if(!function_exists('deleteMedia')) {
    function deleteMedia(?string $filePath, string $disk = 'public') {
        try {
            if ($filePath && Storage::disk($disk)->exists($filePath)) {
                Storage::disk($disk)->delete($filePath);
                return true;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

// get media url
if(!function_exists('getMediaUrl')) {
    function getMediaUrl(?string $filePath, string $disk = 'public') {
        if ($filePath && Storage::disk($disk)->exists($filePath)) {
            return Storage::disk($disk)->url($filePath);
        }

        return null;
    }
}

// get media download url
if(!function_exists('getMediaDownloadUrl')) {
    function getMediaDownloadUrl(?string $filePath, string $disk = 'public') {
        if ($filePath && Storage::disk($disk)->exists($filePath)) {
            return Storage::disk($disk)->download($filePath);
        }

        return null;
    }
}

// generate unique file name
if(!function_exists('generateUniqueFileName')) {
    function generateUniqueFileName($file, $random = true) {

        if ($random) {
            $extension = $file->getClientOriginalExtension();

            $uniqueId = Str::random(8);
            $datePrefix = Carbon::now()->format('Y-m-d');

            return "{$datePrefix}-{$uniqueId}.{$extension}";
        } else {
            return $file->getClientOriginalName();
        }
        
    }
}