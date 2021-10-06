<?php

namespace App\Http\Controllers;

use App\Api\ApiMessages;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function index()
    {
        $users = $this->user->paginate('10');
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        //Se campo password nao for passado, ou ser null
        if(!$request->has('password') || !$request->get('password'))
        {
            $message = new ApiMessages('É necessário informar uma senha para o usuário');
            return response()->json($message->getMessage(), 401);
        }

        try{
            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);

            return response()->json([
                'data'=>[
                    'msg' => 'Usuário cadastrado com sucesso!'
                ]
            ],200);
        } catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try{
            //Indica que a busca deve vir com os dados de profile
            $users = $this->user->with('name')->findOrFail($id);

            return response()->json([
                'data'=>$users
            ],200);
        } catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();

        //Se existir campo password e não for vazia, faz alteração da senha
        if($request->has('password') && $request->get('password')) {
            $data['password'] = bcrypt($data['password']);
        }
        else {
            unset($data['password']);
        }

        try{
            $user = $this->user->findOrFail($id);
            $user->update($data);

            return response()->json([
                'data'=>[
                    'msg' => 'Sucesso! Usuário alterado com sucesso!'
                ]
            ],200);
        } catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $users = $this->user->findOrFail($id);
            $users->delete();

            return response()->json([
                'data'=>[
                    'msg' => 'Usuário removido com sucesso!'
                ]
            ],200);
        } catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
