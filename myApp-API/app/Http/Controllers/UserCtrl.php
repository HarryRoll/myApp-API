<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
Use App\Models\User;

class UserCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::All();
        
        return response()->json([
            'message' => "Data succesfully fetched",
            'status' => Response::HTTP_OK,
            'data' => $user], 
            Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:15',
            'roles' => 'required|max:10',
            'password' => 'required'
        ]);


        try {
            $validated['password'] = bcrypt($validated['password']);
            $createUser = User::create($validated);

            return response()->json([
                'message' => 'User created has been succesfully',
                'code' => Response::HTTP_OK,
                'data' => $createUser
                ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Created user failed',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|max:15',
            'roles' => 'required|max:10'
        ]);

        $user = User::findOrFail($id);

        try {
            $user->update([
                'username' => $request->username,
                'roles' => $request->roles,
                'password' => bcrypt($request->password)
            ]);
    
            return response()->json([
                'message' => 'User updated has been succesfully',
                'code' => Response::HTTP_OK,
                'data' => $user
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Updated user failed',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'message' => 'Data user succesfully fetched',
                'code' => Response::HTTP_OK,
                'data' => $user
            ]);
        } catch (\Exception $e) {
                return response()->json([
                'message' => 'Data user not found',
                'code' => Response::HTTP_NOT_FOUND,
                'error' => $e->getMessage()
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return response()->json([
                'message' => "data id {$id} has been deleted"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "user id {$id} not found",
                'code' => Response::HTTP_NOT_FOUND,
                'error' => $e->getMessage()
            ]);
        }
    }
}
