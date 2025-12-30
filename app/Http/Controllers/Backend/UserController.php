<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Models\BidangKeahlian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $roles = Role::all();
        return view('Backend.managementUser.index', compact('roles'));
    }

    public function getData()
    {
        $users = User::query()
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select([
                'users.*',
                'roles.name as role'
            ]);

        return DataTables::of($users)
            ->addIndexColumn()

            ->addColumn('status', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success">Aktif</span>'
                    : '<span class="badge bg-secondary">Nonaktif</span>';
            })

            ->addColumn('avatar', function ($row) {
                if ($row->avatar) {
                    return '
                <img src="' . asset('storage/user/' . $row->avatar) . '"
                     class="img-thumbnail preview-user"
                     data-img="' . asset('storage/user/' . $row->avatar) . '"
                     style="width:60px; cursor:pointer;">
                ';
                }
                return '-';
            })
            ->addColumn('aksi', function ($row) {
                $updateUrl = route('dosen.update', $row->id);
                return '
                <div class="d-flex gap-1">
                    <button class="btn btn-warning btn-sm editBtn"
                        data-id="' . $row->id . '"
                        data-update="' . $updateUrl . '">
                        <i class="bx bx-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm deleteBtn" data-id="' . $row->id . '">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            ';
            })
            ->rawColumns(['avatar', 'aksi', 'status'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'role_id'   => 'required|exists:roles,id',
            'is_active' => 'required|boolean',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'name',
            'email',
            'role_id',
            'is_active'
        ]);

        // 🔐 password otomatis: name_123
        $passwordPlain = strtolower(str_replace(' ', '', $request->name)) . '_123';
        $data['password'] = bcrypt($passwordPlain);

        // upload avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $nama = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('user', $nama, 'public');
            $data['avatar'] = $nama;
        }

        $user = User::create($data);

        return response()->json([
            'status'   => true,
            'message'  => 'User berhasil ditambahkan',
            'data'     => $user,
            'password' => $passwordPlain // ⚠️ kirim hanya jika perlu ditampilkan
        ]);
    }

    public function show($id)
    {
        $agenda = User::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'name' => $agenda->name,
                'email' => $agenda->email,
                'role_id' => $agenda->role_id,
                'is_active' => $agenda->is_active,
                'avatar' => $agenda->avatar ? asset('storage/user/' . $agenda->avatar) : null,
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role_id'   => 'required|exists:roles,id',
            'is_active' => 'required|boolean',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'name',
            'email',
            'role_id',
            'is_active'
        ]);

        /**
         * 🔐 Update password otomatis jika nama berubah
         */
        if ($request->name !== $user->name) {
            $data['password'] = Hash::make(
                strtolower(str_replace(' ', '_', $request->name)) . '_123'
            );
        }

        /**
         * 🖼️ Upload avatar baru
         */
        if ($request->hasFile('avatar')) {

            if ($user->avatar && Storage::disk('public')->exists('user/' . $user->avatar)) {
                Storage::disk('public')->delete('user/' . $user->avatar);
            }

            $file = $request->file('avatar');
            $nama = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('user', $nama, 'public');

            $data['avatar'] = $nama;
        }

        $user->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'User berhasil diperbarui',
            'data'    => $user
        ]);
    }

    public function destroy($id)
    {
        $agenda = User::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = User::with('role')->onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'role_id' => $item->role->name,
                    'deleted_at' => $item->deleted_at,
                    'avatar' => $item->avatar
                        ? asset('storage/user/' . $item->avatar)
                        : null
                ];
            })
        ]);
    }

    public function restore($id)
    {
        $barang = User::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $agenda = User::withTrashed()->findOrFail($id);

        // Hapus file foto
        if ($agenda->avatar && Storage::disk('public')->exists('user/' . $agenda->avatar)) {
            Storage::disk('public')->delete('user/' . $agenda->avatar);
        }

        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
