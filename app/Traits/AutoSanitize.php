<?php

namespace App\Traits;

use App\Helpers\SanitizeHelper;

// trait AutoSanitize
// {
//     /**
//      * Sanitize all request input before controller methods
//      */
//     public function sanitizeRequest()
//     {
//         request()->merge(
//             SanitizeHelper::sanitizeArray(request()->all())
//         );
//     }
// }

trait AutoSanitize
{
    /**
     * Sanitize all request input before controller methods
     *
     * @param array $htmlFields Manual whitelist of fields allowing HTML (optional)
     * @param bool $autoDetect Enable auto-detect WYSIWYG fields by name (default: false)
     */
    public function sanitizeRequest(array $htmlFields = [], bool $autoDetect = false)
    {
        request()->merge(
            SanitizeHelper::sanitizeArray(request()->all(), $htmlFields, $autoDetect)
        );
    }
}
