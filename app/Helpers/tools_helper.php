<?php
if (!function_exists('img_tag')) {
    /**
     * Generate an image tag for an image file.
     *
     * @param string $path
     * @param array  $attributes
     * @return string
     */
    function img_tag($path, $attributes = []) {
        return img($path, false, $attributes);
    }
}