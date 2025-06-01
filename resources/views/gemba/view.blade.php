<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<x-head/>

<body class="dark:bg-neutral-800 bg-neutral-100 dark:text-white">

    <div class="navbar-header border-b border-neutral-200 dark:border-neutral-600">
        <div class="flex items-center justify-between">
            {{-- Back Button - Start  --}}
            <div class="col-auto">
                <div class="flex flex-wrap items-center gap-[16px]">
                    <a href="$"> <iconify-icon icon="iconoir:arrow-left" class="icon"></iconify-icon> </a>
    
                </div>
            </div>
            {{-- Back Button - End  --}}


            <div class="col-auto">
                <p class="font-semibold mb-0 dark:text-white text-xl">Genba Session - Team Alpha Meeting</p>
                <p class="text-center ">15 Mei 2025 - 10:00 WIB</p>
            </div>
            
            {{-- Dark Mode Swtich - Start  --}}
            <div class="col-auto">
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" id="theme-toggle" class="w-10 h-10 bg-neutral-200 dark:bg-neutral-700 dark:text-white rounded-full flex justify-center items-center">
                        <span id="theme-toggle-dark-icon" class="hidden">
                            <i class="ri-sun-line"></i>
                        </span>
                        <span id="theme-toggle-light-icon" class="hidden">
                            <i class="ri-moon-line"></i>
                        </span>
                    </button>
                </div>
            </div>
            {{-- Dark Mode Swtich - End  --}}
        </div>
    </div>

    @include('sweetalert::alert')

    <div class="dashboard-main-body">
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-base font-medium text-secondary-light mb-0">Daftar Isu </span>
                    <form class="navbar-search">
                        <input type="text" class="bg-white dark:bg-neutral-700 h-10 w-auto" name="search" placeholder="Cari isu">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>
                </div>

                <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Tambahkan Isu Baru
                </button>
            </div>
            <div class="card-body p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 3xl:grid-cols-4 gap-6">
                    
                </div>
                
            </div>
        </div>
    </div>

    <x-script/>

    <script>
        // ================== Password Show Hide Js Start ==========
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on("click", function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle(".toggle-password");
        // ========================= Password Show Hide Js End ===========================
</script>

</body>
</html>
