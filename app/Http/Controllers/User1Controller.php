<?php

namespace App\Http\Controllers;

use App\Models\UserJob;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use DB;


class User1Controller extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getUsers()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
    * Return the list of users
    * @return Illuminate\Http\Response
    */

    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function add(Request $request ){
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0'
        ];
        $this->validate($request,$rules);
        $userjob = UserJob::findorFail($request->jobid);
        $user = User::create($request->all());
        return $this->successResponse($user,Response::HTTP_CREATED);
    }

    /**
    * Obtains and show one user
    * @return Illuminate\Http\Response
    */

    public function show($id){
        $user = User::findOrFail($id);
        return $this->successResponse($user);
        // old code
        $user = User::where('userid', $id)->first();
        if($user){
            return $this->successResponse($user);
        }
        else{
            return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
    }

    /**
    * Update an existing author
    * @return Illuminate\Http\Response
    */

    public function update(Request $request,$id){
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];
        $this->validate($request, $rules);
        $userjob = UserJob::findOrFail($request->jobid);
        $user = User::findOrFail($id);
        $user->fill($request->all());
        // if no changes happen
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();
        return $this->successResponse($user);
        // old code
        $this->validate($request, $rules);
        //$user = User::findOrFail($id);
        $user = User::where('userid', $id)->first();
        if($user){
            $user->fill($request->all());
            // if no changes happen
            if ($user->isClean()) {
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $user->save();
            return $this->successResponse($user);
        }
        else{
            return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
    }

    /**
    * Remove an existing user
    * @return Illuminate\Http\Response
    */

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return $this->successResponse($user);
        // old code
        $user = User::where('userid', $id)->first();
        if($user){
            $user->delete();
            return $this->successResponse($user);
        }
        {
            return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
    }
}