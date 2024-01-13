<?php

namespace Juzaweb\Http\Controllers\FileManager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Juzaweb\Support\FileManager;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Juzaweb\Models\MediaFile;
use Juzaweb\Models\MediaFolder;
use Auth;

class UploadController extends FileManagerController
{
    protected $errors = [];

    public function upload(Request $request)
    {
        $folderId = $request->input('working_dir');

        if (empty($folderId)) {
            $folderId = null;
        }
        $new_filename = null;
        $new_path = null;
        try {
           if($request->input('upload_type')==1){
            if ($request->hasFile('upload')) {
            //    print_r($_FILES['upload']);
               $cfile = curl_file_create($_FILES['upload']['tmp_name'],$_FILES['upload']['type'],$_FILES['upload']['name']);
                $postRequest = array(
                    'api_key' => 'img64626294050361684169364k',
                    'endpoint' => 'ImageUpload',
                    'image'=>$cfile,
                    'title' => 'welcome logo'
                );
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://img.createkwservers.com/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postRequest,
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $res = json_decode($response,true);
                if($res["status"]=="success"){
                    $media = MediaFile::create([
                        'imgId' => $res["data"]["imgId"],
                        'name' => $res["data"]["title"],
                        'type' => 'image',
                        'mime_type' =>  $res["data"]["mime_type"],
                        'path' => $res["data"]["imgs"]["small"],
                        'imgs' => json_encode($res["data"]["imgs"]),
                        'size' => $res["data"]["size"],
                        'extension' => $res["data"]["extension"],
                        'folder_id' => $folderId,
                        'user_id' => Auth::id(),
                    ]);
                    echo 'OK';
                }
            }
        }else{
            $receiver = new FileReceiver('upload', $request, HandlerFactory::classFromRequest($request));
            if ($receiver->isUploaded() === false) {
                throw new UploadMissingFileException();
            }
            $save = $receiver->receive();
                //dd($save);
            if ($save->isFinished()) {
                FileManager::addFile($save->getFile(), $this->getType(), $folderId);
                // event
                return $this->response($this->errors);
            }
            $handler = $save->handler();

            return response()->json([
                "done" => $handler->getPercentageDone(),
                'status' => true,
            ]);
          }
        } catch (\Exception $e) {
            Log::error($e);
            array_push($this->errors, $e->getMessage());

            return $this->response($this->errors);
        }
    }

    protected function response($error_bag)
    {
        $response = count($error_bag) > 0 ? $error_bag : parent::$success_response;

        return response()->json($response);
    }
}
