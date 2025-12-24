<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();
        return view('equipments.index', compact('equipments'));
    }

    public function create()
    {
        return view('equipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Equipment::create($request->all());

        return redirect()->route('equipments.index')
                        ->with('success','Equipamento criado com sucesso.');
    }

    public function show(Equipment $equipment)
    {
        return view('equipments.show',compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        return view('equipments.edit',compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $equipment->update($request->all());

        return redirect()->route('equipments.index')
                        ->with('success','Equipamento atualizado com sucesso');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipments.index')
                        ->with('success','Equipamento deletado com sucesso');
    }
}
