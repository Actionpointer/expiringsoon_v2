<?php

namespace App\Handlers;

use App\Models\User;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        
        // Get the store slug from the session
        $storeSlug = session('store_slug');
        if ($storeSlug) {
            return $storeSlug;
        }
        
        // Fallback to user ID if no store slug in session
        return parent::userField();
    }
}
