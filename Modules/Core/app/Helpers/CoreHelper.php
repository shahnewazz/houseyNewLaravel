<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Core\Enums\SiteSettingEnum;

if (!function_exists('sanitize_username')) {
    /**
     * Sanitize and validate a username to only allow a-z and underscores.
     *
     * @param string $username
     * @return string|null
     */
    function sanitize_username($username): ?string
    {
        $sanitizedUsername = preg_replace('/[^a-z_]/', '', strtolower($username));

        if (preg_match('/^[a-z_]+$/', $sanitizedUsername)) {
            return $sanitizedUsername;
        }

        return null;
    }
}


// env file update function
if (!function_exists('updateEnv')) {
    /**
     * Update the .env file with the given key value pair.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    function updateEnv(string $key, string $value, bool $rebuildConfigCache = true): bool
    {
        $envFile = base_path('.env');
        $envContent = File::get($envFile);

        // Regular expression to find the key
        $pattern = "/^$key=.*/m";

        // Check if the key exists in the .env file
        if (preg_match($pattern, $envContent)) {
            // Replace the line with the new value
            $envContent = preg_replace($pattern, "$key=$value", $envContent);
        } else {
            // If the key does not exist, add it to the end
            $envContent .= "\n$key=$value";
        }

        // Save the updated content back to the .env file
        if(File::put($envFile, $envContent)){
            

            return true;
        }
        return false;
    }
}

if (!function_exists('updateMultiEnv')) {
    /**
     * Update the .env file with the given key-value pairs.
     *
     * @param array $data
     * @return bool
     */
    function updateMultiEnv(array $data, bool $rebuildConfigCache = true): bool
    {
        $envFile = base_path('.env');
        $envContent = File::get($envFile);

        foreach ($data as $key => $value) {
            // Regular expression to find the key
            $pattern = "/^$key=.*/m";

            // Check if the key exists in the .env file
            if (preg_match($pattern, $envContent)) {
                // Replace the line with the new value
                $envContent = preg_replace($pattern, "$key=$value", $envContent);
            } else {
                // If the key does not exist, add it to the end
                $envContent .= "\n$key=$value";
            }
        }


        if (File::put($envFile, $envContent)) {
            
            return true;
        }

        return false;
    }
}


if(!function_exists('core_paginate')){
    function core_paginate($items, $perPage = SiteSettingEnum::PAGINATION_LIMIT, $pageName = 'page'){
        // Get current page from the request, default to 1
        $currentPage = Request::get($pageName, 1);

        // Slice the items array for the current page
        $currentItems = array_slice($items, ($currentPage - 1) * $perPage, $perPage);

        // Create a LengthAwarePaginator instance
        return new LengthAwarePaginator(
            $currentItems, // Current page items
            count($items), // Total items
            $perPage, // Items per page
            $currentPage, // Current page number
            ['path' => Request::url(), 'query' => Request::query()] // Preserving query parameters
        );
    }
}