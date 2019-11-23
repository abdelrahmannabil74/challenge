<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class DataProviedrXTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.

     * @return array
     */
    public function transform($user)
    {
        if($user['statusCode'] == 1)
            $status = 'authorised';
        elseif($user['statusCode'] == 2)
            $status ='declined';
        else
            $status = 'refunded';

        return [

        'balance' => $user['parentAmount'],

        'currency' => $user['Currency'],

        'email' => $user['parentEmail'],

        'status' => $status,

        'created_at' => $user['registerationDate'],

        'id' => $user['parentIdentification'],

        ];
    }
}
