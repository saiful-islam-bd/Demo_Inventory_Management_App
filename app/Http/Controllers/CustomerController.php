<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::select(['id', 'name', 'email', 'number', 'address', 'created_at', 'updated_at']);
            return DataTables::of($customers)
                ->addColumn('action', function ($row) {
                    return '
                        <button type="button" class="btn btn-success btn-sm edit" data-id="' . $row->id . '">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customers.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'number' => 'required',
            'address' => 'required' . $request->id,
        ]);

        Customer::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name, 'email' => $request->email, 'number' => $request->number, 'address' => $request->address,]
        );


        return response()->json(['success' => 'customers saved successfully!']);
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'number' => 'required',
            'address' => 'required',
        ]);

        $customer = Customer::findOrFail($id); // Find the customer
        $customer->update($request->all()); // Update with request data

        return response()->json(['message' => 'customer updated successfully!']);
    }


    
    public function destroy($id)
    {
        Customer::find($id)->delete();
        return response()->json(['success' => 'customer deleted successfully!']);
    }
}



