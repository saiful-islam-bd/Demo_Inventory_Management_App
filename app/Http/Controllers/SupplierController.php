<?php
namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $suppliers = Supplier::select(['id', 'name', 'email', 'number', 'company', 'address', 'created_at', 'updated_at']);
            return DataTables::of($suppliers)
                ->addColumn('action', function ($row) {
                    return '
                        <button type="button" class="btn btn-success btn-sm edit" data-id="' . $row->id . '">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('suppliers.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:suppliers',
            'number' => 'required',
            'company' => 'required',
            'address' => 'required' . $request->id,
        ]);

        Supplier::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name, 'email' => $request->email, 'number' => $request->number,'company' => $request->company, 'address' => $request->address,]
        );


        return response()->json(['success' => 'supplier saved successfully!']);
    }


    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'number' => 'required',
            'company' => 'required',
            'address' => 'required',
        ]);

        $supplier = Supplier::findOrFail($id); 
        $supplier->update($request->all()); // Update with request data

        return response()->json(['message' => 'supplier updated successfully!']);
    }


    
    public function destroy($id)
    {
        Supplier::find($id)->delete();
        return response()->json(['success' => 'supplier deleted successfully!']);
    }
}



