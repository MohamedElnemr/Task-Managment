<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2021-07-15
 * Time: 4:55 PM
 */

namespace App\Helpers;
use Throwable;
use File;
class FileUploader
{
//try {
//    // Validate the value...
//} catch (Throwable $e) {
//    report($e);
//
//    return false;
//}


    public function upload($destinationPath, $field, $newName = ''){

        $destinationPath =  public_path().'/'. $destinationPath;
        $extension = $field->getClientOriginalExtension();
        $fileName = time() . '-' . rand(1, 999) . '.' . $extension;
        $field->move($destinationPath, $fileName);
        return $fileName;
    }

    public function uploadBase64($destinationPath, $mediaData,$extension ,$newName = ''){

        try {

//        $extension =$this->getBase64FileExtention($mediaData,$extension);
        $fileName = time() . '-' . rand(1, 999) .$extension;
        $destinationPath =  public_path().'/'. $destinationPath.'/'.$fileName;
//        $file=$this->make($mediaData);
        file_put_contents($destinationPath, base64_decode($mediaData));
        }catch (Throwable $exception){
            abort(500, "File Not Valid");
        }
        return $fileName;
    }

    public function make($file)
    {

        try {
            $fileExtention = $this->getBase64FileExtention($file);
            $fileType = $this->getBase64FileType($file);
            $file = str_replace('data:'.$fileType.'/' . $fileExtention . ';base64,', '', $file);
            return $file;
        }catch (Throwable $exception){
            report("File Not Valid");
        }
    }


    public function getBase64FileExtention($media){

        $slashPos = strpos($media,'/');
        $simicolunPos = strpos($media, ';');

        $typeStringLength = $simicolunPos - ($slashPos+1);

        return substr($media,$slashPos+1,$typeStringLength);
    }

    public function getBase64FileType($media){

        $slashPos = strpos($media,':');
        $simicolunPos = strpos($media, '/');
        $typeStringLength = $simicolunPos - ($slashPos+1);

        return substr($media,$slashPos+1,$typeStringLength);
    }
    public function isInTypes($type, $types){

        if(in_array($type,$types)){
            return true;
        }
        return false;
    }


}