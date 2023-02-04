<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Score;
use App\Models\User;

class ScoreCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $result = Score::All();
        // return $result;

        $result = User::join('score', 'users.id', '=', 'score.id_user')
            ->join('subject', 'score.id_bs', '=', 'subject.id')
            ->where('users.id', '=', $id)
            ->get();

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
		$quest = DB::table('question')
		->where('question.id_bs', '=', $data->id)
		->get();
		
        $correct = 0;
        $score = 0;
		foreach ($quest as $q) {
		 	if($q->correct_answer === $data->{$q->id}){
                error_log($correct++);
                error_log('oke'.$q->id);

                $score = $correct * 10;
		    }};

        error_log($score);    
		error_log($data->{3});
		error_log($quest);
        //Log::info("oke");
    
        $fill = [
            "id_bs" => $data->id,
            "id_user" => $data->user_id,
            "score" => $score
        ];
    
        $result = Score::create($fill);
        
        return $fill;    
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
