<!-- Main modal -->
<div 
class="@if($show == true) flex @endif bg-neutral-600/10 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
style="display: @if($show === true)
                 flex
         @else
                 none
         @endif;"
         >
    <div class="relative p-4 w-full  max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> 
                
                @if ($mode == "create")
                    Tambahkan Pengguna Baru
                @else
                    Edit Informasi Pengguna
                @endif
                
                </h3>
                <button wire:click="doClose()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup Formulir</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <form id="user-form" action="{{ $mode == "create" ? route("users.create") : route("users.update") }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($mode !=  'create')
                        <input type="text" name="id" id="id" value="{{ $user->id }}" hidden>
                    @endif

                    <div class="mb-3">
                        <label for="name" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Nama Pengguna</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama pengguna " id="name" name="name" required value="{{ $user->name ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Email</label>
                        <input type="text" class="form-control" placeholder="Masukan alamat email" id="email" name="email" required value="{{ $user->email ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="department" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Departemen</label>
                        <select class="form-control" id="department" name="department" required>
                            <option class="text-black" value="manufacture" @if($user && $user->department == 'manufacture') selected @endif>Manufaktur</option>
                            <option class="text-black" value="qc" @if($user && $user->department == 'qc') selected @endif>Quality Control</option>
                            <option class="text-black" value="management" @if($user && $user->department == 'management') selected @endif>Manajemen</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option class="text-black" value="admin" @if($user && $user->role == 'admin') selected @endif>Admin</option>
                            <option class="text-black" value="user" @if($user && $user->role == 'user') selected @endif>Karyawan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Kata Sandi</label>
                        <div class="relative mb-5">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Buat kata sandi default">
                            <span class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light" data-toggle="#your-password"></span>
                        </div>
                    </div>
                    <div class="mb-3 col-span-2">
                        <label for="profile_photo" class="form-label">Foto Profil</label>
                        <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="profile_photo" id="profile_photo" accept="image/*">
                    </div>
                    <div class="mb-3 col-span-2">
                        <label for="cover_photo" class="form-label">Foto Sampul</label>
                        <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="cover_photo" id="cover_photo" accept="image/*">
                    </div>
                    
                </form>
            </div>
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button wire:click="doClose()" type="button" data-modal-hide="default-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Batal
                </button>
                <button id="save-user" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                    @if ($mode == 'create')
                        Tambahkan Pengguna
                    @else
                        Simpan Perubahan
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>

@push('lv-scripts')
    <script>
        
        $('#save-user').on('click', function(e) {
            e.preventDefault();

            $('#user-form').submit();
        });
    </script>
@endpush