<!-- Modal Tambah / Edit User -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate" data-store="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- ID Hidden untuk edit --}}
                    <input type="hidden" id="userId" name="id">

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Masukkan nama lengkap" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Masukkan email" required>
                    </div>

                    {{-- Role --}}
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status Akun</label>
                        <select name="is_active" id="is_active" class="form-select" required>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>

                    {{-- Avatar --}}
                    <div class="mb-3">
                        <label class="form-label">Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                        <small class="text-muted">JPG, PNG, WEBP (Max 2MB)</small>
                    </div>

                    {{-- Preview Avatar --}}
                    <div class="mb-3">
                        <label class="form-label">Preview Avatar</label>
                        <div id="previewFoto"></div>
                    </div>

                    {{-- Info Password --}}
                    <div class="alert alert-info">
                        <strong>Password Default:</strong>
                        <span class="text-monospace">nama_123</span><br>
                        <small>Password dibuat otomatis berdasarkan nama user</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan User
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
