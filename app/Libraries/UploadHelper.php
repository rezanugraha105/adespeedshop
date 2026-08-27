<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Files\UploadedFile;

class UploadHelper
{
    /**
     * Maps PHP's own detected image type (from the file's real binary header,
     * via getimagesize()) to a safe, server-controlled extension.
     *
     * We deliberately do NOT trust CI4's is_image/mime_in rules alone, nor the
     * client-supplied filename/extension/mime header — CI4 <4.7.4 has a known
     * validation-bypass advisory (CVE-2026-63223) for exactly those rules, and
     * upgrading requires PHP 8.2+ which this environment does not have yet.
     * getimagesize() parses the actual image binary structure, which is far
     * harder to spoof than a Content-Type header or file extension.
     */
    private const ALLOWED_IMAGE_TYPES = [
        IMAGETYPE_JPEG => 'jpg',
        IMAGETYPE_PNG  => 'png',
        IMAGETYPE_WEBP => 'webp',
    ];

    /**
     * Independently verifies the upload is a genuine image of an allowed type.
     * Call this in addition to (not instead of) the normal validate() rules.
     */
    public static function isGenuineImage(?UploadedFile $file): bool
    {
        if ($file === null || ! $file->isValid() || $file->hasMoved()) {
            return false;
        }

        $info = @getimagesize($file->getTempName());

        return $info !== false && isset(self::ALLOWED_IMAGE_TYPES[$info[2]]);
    }

    /**
     * Stores the file under writable/uploads/{subfolder}/ (outside the public
     * webroot, so files are only reachable through the authenticated
     * Files::show route) using a filename this method controls entirely —
     * never the client-supplied name or extension.
     *
     * Returns null if no file was given, or if it fails the genuine-image
     * check. Callers must treat a null return (when a file was actually
     * submitted) as a validation failure, not as "no file provided".
     */
    public static function store(?UploadedFile $file, string $subfolder): ?string
    {
        if (! self::isGenuineImage($file)) {
            return null;
        }

        $info      = getimagesize($file->getTempName());
        $extension = self::ALLOWED_IMAGE_TYPES[$info[2]];
        $newName   = date('YmdHis') . '_' . bin2hex(random_bytes(16)) . '.' . $extension;

        $targetDir = WRITEPATH . 'uploads/' . $subfolder;
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $newName);

        return $subfolder . '/' . $newName;
    }

    public static function delete(?string $relativePath): void
    {
        if (! $relativePath) {
            return;
        }

        $fullPath = WRITEPATH . 'uploads/' . $relativePath;
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
