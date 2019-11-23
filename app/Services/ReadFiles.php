<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;

class ReadFiles
{


    /**
     * @param $path
     * @return mixed
     */
    public function handle($path)
    {
          $content = file_get_contents(storage_path($path));

        $content =  json_decode($content,true);

          return $content;
    }
}
