<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tarea::orderBy('created_at', 'desc')->get();
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tareas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable',
            'estado' => 'required|in:pendiente,completada'
        ], [
            'titulo.required' => 'El título es obligatorio',
            'titulo.max' => 'El título no puede superar los 255 caracteres',
            'estado.required' => 'El estado es obligatorio',
            'estado.in' => 'El estado debe ser pendiente o completada'
        ]);

        Tarea::create($request->all());

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable',
            'estado' => 'required|in:pendiente,completada'
        ], [
            'titulo.required' => 'El título es obligatorio',
            'titulo.max' => 'El título no puede superar los 255 caracteres',
            'estado.required' => 'El estado es obligatorio',
            'estado.in' => 'El estado debe ser pendiente o completada'
        ]);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada correctamente');
    }
}