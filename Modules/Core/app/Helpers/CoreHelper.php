<?php

if (!function_exists('sanitize_username')) {
    /**
     * Sanitize and validate a username to only allow a-z and underscores.
     *
     * @param string $username
     * @return string|null
     */
    function sanitize_username($username)
    {
        $sanitizedUsername = preg_replace('/[^a-z_]/', '', strtolower($username));

        if (preg_match('/^[a-z_]+$/', $sanitizedUsername)) {
            return $sanitizedUsername;
        }

        return null;
    }
}
