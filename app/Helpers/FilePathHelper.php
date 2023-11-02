<?php
if (!function_exists('productImagePath')) {
    function productImagePath(string $fileName): string
    {
        return "storage/shop/images/products/" . $fileName;
    }
}
