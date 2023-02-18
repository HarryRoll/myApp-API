<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Subject;
use App\Models\QuestionModel;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class QuestionCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject =Subject::All();
        $score_exist = Subject::join('score', 'subject.id', '=', 'score.id_bs')->get();
        return Response()->json([
            "message" => "Subject request succesfully",
            "code" => Response::HTTP_OK,
            "data" => [
                "subject" => $subject,
                "score_exist" => $score_exist
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        if(auth()->user()->roles === 'admin') {
            $request->validate([
                'subject' => 'required'
            ]);
    
            // error_log($request);
    
            $fill = [
                "subject_name" => $request->subject,
                "subject_Description" => $request->subject_Description
            ];
    
            $newSubject = Subject::create($fill);
    
            return Response()->json([
                "message" => "new subject add succesfully",
                "code" => Response::HTTP_OK,
                "data" => $newSubject
            ], Response::HTTP_OK);
        }
        else
        { 
            return Response()->json([
                "message" => "Not access permission",
                "code" => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);          
        }
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAns(Request $request)
    {   
        $request->validate([
            'answered' => 'required',
            'id_qst' => 'required',
            'pg' => 'required'
        ]);

        $fill = [
            'id_qst' => $request->id_qst,
            'pg' => $request->pg,
            'answered' => $request->answered
        ];

        $result = Answer::create($fill);

        return $result;
        
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createQuest(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'id_bs' => 'required',
            'correct_answer' => 'required'
        ]);

    $fill = [
		'id_bs'=> $request->id_bs,
		'question' => $request->question,
		'correct_answer' => $request->correct_answer
	];

    $result = QuestionModel::create($fill);
    return $result;  

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = QuestionModel::whereId_bs($id)->get();
			
		$answer = DB::table('answer')
		->join('question', 'answer.id_qst', '=', 'question.id')
		->where('question.id_bs','=', $id)->get();

		return response()->json([
			'message' => 'Get data succesfully',
			'code' => Response::HTTP_OK,
			'data' => [
				'quest' => $question,
				'ans' => $answer
				
				],
		], Response::HTTP_OK);
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
    
    public function deleteQst($id)
    {
        QuestionModel::destroy($id);
        
        return 'The question has been deleted';
    }
}
