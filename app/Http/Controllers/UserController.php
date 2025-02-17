<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function putnota(Request $request)
    {
        $profesor = User::find(Auth::id());
        $alumno = Student::find($request->alumnoid);
        $alumno->profesores()->attach(Auth::id(), ['asignatura' => $request->asignatura, 'nota' => $request->nota]);
        return to_route('profesor.index');
    }

    public function nota()
    {
        $profesor = User::find(Auth::id());
        $alumnos = $profesor->estudiantesUnico;
        return view('profesor.nota')->with('alumnos', $alumnos);
    }

    public function index()
    {
        //$profesor = Auth::user();
        $profesor = User::find(Auth::id());
        //$alumnos = $profesor->estudiantes()->where('nota', '>', 3)->get();
        $alumnos = $profesor->estudiantes()->paginate(2);

        return view('profesor.index')->with('alumnos', $alumnos);
    }
    public function create()
    {
        return view('profesor.create');
    }

    public function store(Request $request)
    {
        $newAlum = new Student();
        $newAlum->dni = $request->input('dni');
        $newAlum->nombre = $request->input('name');
        $newAlum->apellido = $request->input('apellidos');
        $newAlum->email = $request->input('email');
        $newAlum->curso = $request->input('curso');
        $newAlum->save();
        $newAlum->profesores()->attach(Auth::id(), ['asignatura' => $request->asignatura, 'nota' => $request->nota]);
        return redirect()->route('profesor.index');
    }
}
