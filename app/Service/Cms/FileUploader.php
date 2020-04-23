<?php

declare(strict_types = 1);

namespace App\Service\Cms;

use App\Exception\CustomHttpException;
use Ramsey\Uuid\Uuid;
use Hyperf\HttpMessage\Upload\UploadedFile;

class FileUploader{

    /**
     * 上传文件
     *
     * @param $files
     * @param int $type
     * @return array
     * @throws \Exception
     */
    public static function upload(UploadedFile $file){

        $fileExtension = $file->getExtension();
        $originalFileName = $file->getClientFilename();
        $newFileName = Uuid::uuid1()->toString().".{$fileExtension}";
        $savePath = BASE_PATH . "/runtime/upload/";

        if(!is_dir($savePath)){
            @mkdir($savePath);
        }

        $file->moveTo($savePath.$newFileName);
        if(!$file->isMoved()){
            throw new CustomHttpException("文件上传失败",500,50001);
        }
        return [
            'origname' => $originalFileName,
            'name' => $newFileName
        ];
    }

    /**
     * 获取上传文件
     *
     * @param $fileName
     * @return string
     */
    public static function getUploadFilePath($fileName){
        return BASE_PATH . "/runtime/upload/".$fileName;
    }

}