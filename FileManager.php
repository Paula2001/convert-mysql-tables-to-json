<?php
class FileManager {
    public static function createDirectory($pathname): bool
    {
        if(!file_exists("./$pathname")){
            $oldmask = umask(0);
            mkdir($pathname, 0777);
            umask($oldmask);
            return true;
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
