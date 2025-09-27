<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentcontroller extends Controller
{
    public function studentlist(){
        return view ('student');
    }

    public function studentinfo(){
        return view ('student', ['id' => '001', 
                                'name' => 'Aldrin Sapugay', 
                                'courseyear' => 'BSIT3B'] ); 
    }

    //array()
    public function studentarray(){
        $data = ['studentlist' => [
            ['id' => '001', 'name' => 'Aldrin Sapugay', 'courseyear' => 'BSIT3B'],
            ['id' => '002', 'name' => 'Ian Tumambing', 'courseyear' => 'BSIT3B'],
            ['id' => '003', 'name' => 'Mark Adrian Deleon', 'courseyear' => 'BSIT3B'],
            ['id' => '004', 'name' => 'Matt Villladolid', 'courseyear' => 'BSIT3B'],
            ['id' => '004', 'name' => 'Matt Villladolid', 'courseyear' => 'BSIT3B'],
        ]
        ];
        return view ('student', $data);
    }

    //with()
    public function studWith(){
        $student = [
            ['id' => '001', 'name' => 'Aldrin Sapugay', 'courseyear' => 'BSIT3B'],
            ['id' => '002', 'name' => 'Ian Tumambing', 'courseyear' => 'BSIT3B'],
            ['id' => '003', 'name' => 'Mark Adrian Deleon', 'courseyear' => 'BSIT3B'],
            ['id' => '004', 'name' => 'Matt Villladolid', 'courseyear' => 'BSIT3B'],
        ];
            return view ('student')->with('studentlist', $student);
    }

    //compact()
    public function studcompact(){
        $studentlist = [
            ['id' => '001', 'name' => 'Aldrin Sapugay', 'courseyear' => 'BSIT3B'],
            ['id' => '002', 'name' => 'Ian Tumambing', 'courseyear' => 'BSIT3B'],
            ['id' => '003', 'name' => 'Mark Adrian Deleon', 'courseyear' => 'BSIT3B'],
            ['id' => '004', 'name' => 'Matt Villladolid', 'courseyear' => 'BSIT3B'],
        ];
            return view ('student', compact('studentlist'));
    }

    //to add
    public function studmasterlist(Request $request){
        $studentlist = $request->session()->get('students', []);
        $search = $request->input('search');
    if (!empty($search)) {
        $filtered = [];
    foreach ($studentlist as $student) {
        if (strpos(strtolower($student['name']), strtolower($search)) !== false) {
        $filtered[] = $student;
         }
    }
    $studentlist = $filtered;
}
        //session - is nasasave galing sa web browser, located in storage, framework, session
        return view ('student', compact('studentlist'));
    }

    public function addstudent(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'courseyear' => 'required'
        ]);

        $studentlist = $request->session()->get('students', []);

        $studentlist[] = [
            'id' => $request -> id,
            'name' => $request -> name,
            'courseyear' => $request -> courseyear,
        ];
        $request -> session() -> put('students', $studentlist);

        return redirect() -> route('student.list');
    }
   
    public function editstudent(Request $request, $index) {
    $studentlist = $request->session()->get('students', []);
        if (!isset($studentlist[$index])) {
    return redirect()->route('student.list')->with('error', 'Student not found.');
    }
    $student = $studentlist[$index];
        return view('student_edit', compact('student', 'index'));
    }

    public function updatestudent(Request $request, $index) {
    $request->validate([
        'id' => 'required',
        'name' => 'required',
        'courseyear' => 'required',
    ]);
    $studentlist = $request->session()->get('students', []);
    if (isset($studentlist[$index])) {
    $studentlist[$index] = [
        'id' => $request->id,
        'name' => $request->name,
        'courseyear' => $request->courseyear,
    ];
        $request->session()->put('students', $studentlist);
    }
    return redirect()->route('student.list')->with('success', 'Student updated successfully.');
    }

    public function deletestudent(Request $request, $index) {
    $studentlist = $request->session()->get('students', []);

    if (isset($studentlist[$index])) {
        unset($studentlist[$index]);
        $request->session()->put('students', array_values($studentlist)); // reindex array
        }
    return redirect()->route('student.list')->with('success', 'Student deleted successfully.');
}
    
}
