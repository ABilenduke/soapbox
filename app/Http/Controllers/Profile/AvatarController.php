<?php

namespace App\Http\Controllers\Profile;

use App\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userIdentifier = request()->user()->identifier;
        $avatar = \Image::make($request->avatar)->resize(600, 600)->encode('jpg');
        $avatarName = substr(md5(Carbon::now()->getTimestamp()), 0, 25);
        $avatarPath = "images/avatars/$userIdentifier/$avatarName.jpg";
        
        \Storage::put("public/" . $avatarPath, $avatar);

        request()->user()
            ->avatars()
            ->where('primary', true)
            ->update(['primary' => false]);

        Avatar::create([
            'user_id' => request()->user()->id,
            'path' => $avatarPath,
            'primary' => true
        ]);

        return response()->json([
            'message' => 'uploaded successfully',
            'path' => $avatarPath,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
