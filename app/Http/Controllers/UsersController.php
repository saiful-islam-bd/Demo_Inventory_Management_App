<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'role_id', 'created_at', 'updated_at']);
            return DataTables::of($users)
                ->addColumn('action', function ($row) {
                    return '
                        <button type="button" class="btn btn-success btn-sm edit" data-id="' . $row->id . '">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role_id' => 'required' . $request->id,
        ]);

        User::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name, 'email' => $request->email, 'role_id' => $request->role_id]
        );


        return response()->json(['success' => 'User saved successfully!']);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role_id' => 'required',
        ]);

        $user = User::findOrFail($id); // Find the user
        $user->update($request->all()); // Update with request data

        return response()->json(['message' => 'User updated successfully!']);
    }


    
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => 'User deleted successfully!']);
    }
}
