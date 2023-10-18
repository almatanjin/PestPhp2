<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return response()->json($subjects, 200);
    }
    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'version' => $request->input('version'),
        ];

        $subject = Subject::create($data);

        return response()->json($subject, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::find($id);
        return response()->json($subject, 200);
    }

    public function update(Request $request, string $id)
    {
        $subject = Subject::find($id);

        if(!$subject)
        {
            return response()->json("Subject not found", 404);
        }

        if($request->input("name")){
            $subject->name = $request->input("name");
        }

        if($request->input("version")){
            $subject->version = $request->input("version");
        }

        $subject->save();
        return response()->json($subject,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        
        if(!$subject)
        {
            return response()->json("Subject Not Found",404);
        }

        $subject->delete();
        return response()->json("Subject",200);

    }
}
