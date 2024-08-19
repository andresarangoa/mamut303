<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use Illuminate\Http\Request;
class InsurerController extends Controller
{
    //
    public function index()
    {
        $insurer = Insurer::latest('updated_at')
            ->select(['id','name', 'nit'])
            ->simplePaginate(5);

        return view('insurers.index', [
            'insurers' => $insurer
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'nit' => 'required',
        ]);

        $insurer = new Insurer($data);
        $insurer->save();

        return redirect('/insurers')->with('success', 'insurer created successfully!');
    }
    public function create()
    {
        return view('insurers.create', [
            'insurers' => Insurer::all()
        ]);
    }
    public function edit(Insurer $insurer)
    {
        return view('insurers.edit', [
            'insurer' => $insurer,
        ]);
    }

    public function show(Insurer $insurer)
    {
        return view('insurers.edit', [
            'insurer' => $insurer,
        ]);
    }

    public function update(Request $request, Insurer $insurer)
    {
        $data = $request->validate([
            'name' => 'required',
            'nit' => 'required',
        ]);

        $insurer->update($data);

        return redirect('/insurers')->with('success', 'Insurer updated successfully!');
    }

}
