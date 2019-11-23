<?php

namespace App\Services;


use App\Filters\UserFilters;
use App\Transformers\DataProviedrXTransformer;
use App\Transformers\DataProviedrYTransformer;
use Illuminate\Support\Facades\Storage;
use Spatie\Fractal\Fractal;

class CombineFiles
{
    /**
     * @var ReadFiles
     */
    protected $readFiles;

    protected $filters;

    /**
     * CombineFiles constructor.
     * @param ReadFiles $readFiles
     */
    public function __construct(ReadFiles $readFiles,UserFilters $filters)
    {
        $this->readFiles=$readFiles;
        $this->filters = $filters;
    }

    /**
     * @return array
     */
    public function handle($filters)
    {

        $users=[];

        $files=[['path'=>'jsons/DataProviderX.json','file'=>'DataProviderX','transformer' =>DataProviedrXTransformer::class],
            ['path'=>'jsons/DataProviderY.json','file'=>'DataProviderY','transformer' =>DataProviedrYTransformer::class]];

        if(isset($filters['provider'])){
            $files = $this->filterByProvider($files,$filters['provider']);
        }
        foreach ( $files as $file)
        {
            $content=$this->readFiles->handle($file['path']);

            $data=Fractal::create($content['users'],new $file['transformer'])->toArray()['data'];

            $users=array_merge($users,$data);

        }
        $users = $this->filters->filter($users,$filters);
        return $users;
    }

    public function filterByProvider($files,$provider)
    {
        $files = array_filter($files,function($file) use ($provider) {
            return $file['file'] == $provider;
        });
        return $files;
    }
}
