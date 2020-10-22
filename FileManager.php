<?php
class FileManager {
    public static function createDirectory($pathname): bool
    {
        if(!file_exists("./$pathname")){
            $oldmask = umask(0);
            $fileCreation = mkdir($pathname, 0777);
            umask($oldmask);
            return $fileCreation;
        }else{
            return false;
        }
    }

    public static function createJsonFile($fileName,$content){
        $file = fopen($fileName,"w");
        fwrite($file,$content);
        fclose($file);
    }

}
