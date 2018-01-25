<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect, App\User, App\Score as Score;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $user  = User::orderBy('created_at', 'asc')->get();

        if ($user->isEmpty()) {
            return Redirect::back()->withErrors(['msg', 'You cannot play without any Players. Please add a player and try again.']);
        }

        if (is_null($request->session()->get('usersTurn'))) {
            $request->session()->put('usersTurn', 1);
        }

        return view('scores',
            [
                'users' => $user,
            ]
        );
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
        //
        $validator = Validator::make($request->all(), [
            'score' => 'array|min:1',
            'score.*' => 'array|min:10|max:10',
            'score.*.*' => 'numeric|max:10'
        ]);

        if ($validator->fails()) {
            return redirect('/scores')
                ->withInput()
                ->withErrors($validator);
        }
        foreach ($request->score as $userId => $scoreArray) {
            foreach ($scoreArray as $frame => $requestScore) {
                $score = Score::where('frame',$frame)
                ->where('user_id', $userId)->first();
                if ($score) {
                    $score->update(['value' => $requestScore]);
                    continue;
                }
                $score = new Score;
                $score->frame = $frame;
                $score->user_id = $userId;
                $score->value = $requestScore;
                $score->save();
            }
        }

        return redirect('/scores');
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
