<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class DataProviedrYTransformer extends TransformerAbstract
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
     *
     * @return array
     */
    public function transform($user)
    {
        if($user['status'] == 100)
            $status = 'authorised';
        elseif($user['status'] == 200)
            $status ='declined';
        else
            $status = 'refunded';
        return [

        'balance' => $user['balance'],

        'currency' => $user['currency'],

        'email' => $user['email'],

       'status' => $status,

       'created_at'=> $user['created_at'],

       'id'=> $user['id'],

        ];
    }
}
