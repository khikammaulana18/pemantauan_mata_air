<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('image', function (User $user) {
                    return '<img src="' . asset($user->image != null && $user->image != '-' ? 'uploads/' . $user->image : 'thumbnail/user.png') . '" width="50" class="img img-circle"/>';
                })
                ->addColumn('password', function (User $user) {
                    return '********';
                })
                ->addColumn('action', function (User $user) {
                    $result = '<form action="' . route('pengguna.destroy', $user->id) . '" method="POST" enctype="multipart/form-data">
                ' . method_field('DELETE') . '
                ' . csrf_field() . '
                <a href="' . route('pengguna.edit', $user->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';

                    $result .= '|<button type="submit" class="btn btn-sm btn-danger form-confirm"><i class="fas fa-trash"></i></button>';

                    $result .= '</form>';
                    return $result;
                })
                ->rawColumns(['action', 'image'])
                ->make();
        }
        return view('back.pages.pengguna.index');
    }
    public function create()
    {
        return view('back.pages.pengguna.form');
    }
    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        return view('back.pages.pengguna.form', compact(['data']));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'role' => ['required','in:admin,pelapor']
        ]);
        if ($validator->fails()) {
            $error = '';
            foreach ($validator->errors()->all() as $e) {
                $error .= $e . '<br>';
            }
            return redirect()->back()->with('error', $error)->withInput();
        }
        $image = $this->uploadFile($request, 'image');
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image != null ? $image : 'thumbnail/user.png',
            'role' => $request->role
        ];
        if (User::insert($data)) {
            return redirect()->route('pengguna')->with('success', 'Input Data Berhasil !');
        }
        return redirect()->back()->with('error', 'Oops, Ada kesalahan. silahkan coba lagi !');

    }
    public function update(Request $request, string $id)
    {
        $oldData = User::findOrFail($id);
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required']
        ]);
        if ($validate->failed()) {
            $error = '';
            foreach ($validate->errors()->all() as $e) {
                $error .= $e . '<br>';
            }
            return redirect()->back()->with('error', $error)->withInput();
        }
        $image = $this->uploadFile($request, 'image');
        if ($image && $image != null) {
            $this->deleteFile($oldData->image);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password != null ? Hash::make($request->password) : $oldData->password,
            'image' => $image != null ? $image : $oldData->image,
            'role' => $request->role ?? $oldData->role
        ];

        if ($oldData->update($data)) {
            return redirect()->route('pengguna')->with('success', 'Update Data Berhasil');
        }
        return redirect()->back()->with('error', 'Oops, Ada kesalahan. silahkan coba lagi !');
    }
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $this->deleteFile($data->image);
        $data->delete();
        return redirect()->route('pengguna')->with('success','Hapus Data Berhasil !');
    }
}
