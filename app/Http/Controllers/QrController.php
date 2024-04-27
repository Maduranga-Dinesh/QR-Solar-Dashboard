<?php

namespace App\Http\Controllers;

use App\Models\qr;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index(){
        $qr = qr::orderBy('created_at', 'DESC')->get();

        return view('qr.index', compact('qr'));

    }
    public function create()
    {
        return view('qr.create');
    }

    public function store(Request $request)
    {

        qr::create([
        'qr_id' => $request->input('qr_id'),
        'value' => $request->input('value')
        ]);
        return redirect()->route('admin/qr')->with('success', 'QR added successfully');
    }

    public function show(string $id)
    {
        // $qr = qr::findOrFail($id);

        // return view('qr.show', compact('qr'));
    }

    public function edit(string $id)
    {
        $qr= qr::findOrFail($id);

        return view('qr.edit', compact('qr'));
    }
    public function update(Request $request, string $id)
    {
        $qr = qr::findOrFail($id);

        $qr->update($request->all());

        return redirect()->route('admin/qr')->with('success', 'QR updated successfully');
    }

    public function destroy(string $id)
    {
        $qr = qr::findOrFail($id);

        $qr->delete();

        return redirect()->route('admin/qr')->with('success', 'QR deleted successfully');
    }
}
