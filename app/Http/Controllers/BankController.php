<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $banks = Bank::where('doctor_id', auth()->id())->get();
        if ($request->expectsJson()) {
            return response()->json([
                'banks' => $banks,
            ], 201);
        }
        return view('doctor-dashboard.banks', compact('banks'));
    }

    public function store(Request $request)
{
    $request->validate([
        'holder_name' => 'required|string',
        'bank_name' => 'required|string',
        'account_no' => 'required|string',
        'ifsc' => 'required|string',
        'branch_name' => 'required|string',
    ]);

    Bank::create([
        'doctor_id' => auth()->id(),
        'holder_name' => $request->holder_name,
        'bank_name' => $request->bank_name,
        'account_no' => $request->account_no,
        'ifsc' => $request->ifsc,
        'branch_name' => $request->branch_name,
    ]);

    $banks = Bank::where('doctor_id', auth()->id())->get();

    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'Bank added successfully',
            'banks' => $banks,
        ], 201);
    }

    return redirect()->route('banks.index')->with([
        'success' => 'Bank added successfully',
        'banks' => $banks,
    ]);
}

public function update(Request $request, $id)
{
    $bank = Bank::where('id', $id)->where('doctor_id', auth()->id())->firstOrFail();

    $request->validate([
        'holder_name' => 'required|string',
        'bank_name' => 'required|string',
        'account_no' => 'required|string',
        'ifsc' => 'required|string',
        'branch_name' => 'required|string',
    ]);

    $bank->update($request->all());

    $banks = Bank::where('doctor_id', auth()->id())->get();

    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'Bank updated successfully',
            'banks' => $banks,
        ]);
    }

    return redirect()->route('banks.index')->with([
        'success' => 'Bank updated successfully',
        'banks' => $banks,
    ]);
}

    public function destroy($id)
    {
        $bank = Bank::where('id', $id)->where('doctor_id', auth()->id())->firstOrFail();
        $bank->delete();

        return response()->json(['message' => 'Bank deleted successfully','success'=>true],200);
    }
}
