<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('upload')) {

    /**
     * a helper function that uploads a file
     * into uploads directory after naming it a unique name
     * @param $file
     * @param $path
     * @param $filePath
     * @return false|string
     */
    function upload($file, $path, &$filePath)
    {
        $allowed = array('pdf', 'PDF', 'PNG', 'png', 'jpg', 'JPG', 'jpeg', 'JPEG');
        $fileName = $file['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) return false;

        if ($file['size'] > 2485760) return false;

        $fileName = basename(date("Ymd") . rand(1000, 9999)).'.'.$ext;
        $filePath = $path.'/'. $fileName;

        $uploaded = move_uploaded_file($file["tmp_name"], $filePath);

        if (!$uploaded) return false;

        return true;
    }

    /**
     * Unlink a file, which handles symlinks.
     * @see https://github.com/luyadev/luya/blob/master/core/helpers/FileHelper.php
     * @param string $fileName The file path to the file to delete.
     * @return boolean Whether the file has been removed or not.
     */
    function unlinkFile($fileName)
    {
        // try to force symlinks
        if (is_link($fileName)) {
            $sym = @readlink($fileName);
            if ($sym) {
                return is_writable($fileName) && @unlink($fileName);
            }
        }

        // try to use real path
        if (realpath($fileName) && realpath($fileName) !== $fileName) {
            return is_writable($fileName) && @unlink(realpath($fileName));
        }

        // default unlink
        return is_writable($fileName) && @unlink($fileName);
    }
}