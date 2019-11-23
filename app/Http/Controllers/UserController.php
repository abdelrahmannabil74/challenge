<?php

namespace App\Http\Controllers;

use App\Http\Responses\ResponsesInterface;
use App\Services\CombineFiles;
use App\Services\ReadFiles;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var ResponsesInterface
     */
    protected $responder;
    protected $combineFiles;

    /**
     * MemberController constructor.
     *
     * @param ResponsesInterface $responder
     * @param CombineFiles $combineFiles
     */
    public function __construct(ResponsesInterface $responder,CombineFiles $combineFiles)
    {
        $this->responder = $responder;
        $this->combineFiles = $combineFiles;
    }

    /**
     * @return
     */
    public function index(Request $request)
    {
        $users=$this->combineFiles->handle($request->all());

       return $this->responder->respond($users);
    }



}
