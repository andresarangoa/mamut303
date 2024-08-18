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
            ->select(['name', 'nit'])
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
}
