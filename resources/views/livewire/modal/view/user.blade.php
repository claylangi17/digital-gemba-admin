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
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Detail Pengguna </h3>
                <button wire:click="doClose()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup Formulir</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                @if ($user != null)
                <img src="{{ get_user_cover($user) }}" alt="" style="width: 100% ;height: 120px; object-fit:cover">
                <div class="pe-6 pb-4 ps-6 text-center mt--50">
                    <img src="{{ get_user_avatar($user, 100) }}" alt="" class="border br-white border-width-2-px w-[100px] h-[100px] ms-auto me-auto -mt-[50px] rounded-full object-fit-cover">
                </div>
                @endif
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label for="name" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Nama Pengguna</label>
                        <p>
                            {{ $user->name ?? '' }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Email</label>
                        <p>
                            {{ $user->email ?? '' }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Departemen</label>
                        <p>
                            {{ $user->department ?? '' }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Role</label>
                        <p>
                            {{ $user->role ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button wire:click="doClose()" type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Kembali
                </button>
            </div>
        </div>
    </div>
</div>