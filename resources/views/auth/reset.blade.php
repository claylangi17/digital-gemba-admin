<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<x-head />  

<body class="dark:bg-neutral-800 bg-neutral-100 dark:text-white">

    @include('sweetalert::alert')

    <section class="bg-white dark:bg-neutral-700 flex flex-wrap min-h-[100vh]">
        <div class="lg:w-1/2 lg:block hidden">
            <div class="flex items-center flex-col h-full justify-center">
                <img src="{{ asset('assets/images/auth/forgot-pass-img.png') }}" alt="">
            </div>
        </div>
        <div class="lg:w-1/2 py-8 px-6 flex flex-col justify-center">
            <div class="lg:max-w-[464px] mx-auto w-full">
                <div>
                    <h4 class="mb-3">Atur Ulang Kata Sandi</h4>
                    <p class="mb-8 text-secondary-light text-lg">Silahkan buat kata sandi anda yang baru.</p>
                </div>
                <form action="{{ route('auth.reset.attempt') }}" method="POST">

                    @csrf

                    <input type="text" name="secret" id="secret" value="{{ $token }}" hidden>
                    
                    <div class="relative mb-5">
                        <div class="icon-field">
                            <span class="absolute start-4 top-1/2 -translate-y-1/2 pointer-events-none flex text-xl">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password" id="password" class="form-control h-[56px] ps-11 border-neutral-300 bg-neutral-50 dark:bg-dark-2 rounded-xl" placeholder="Kata Sandi Baru">
                        </div>
                        <span class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light" data-toggle="#password"></span>
                    </div>
                    <div class="relative mb-5">
                        <div class="icon-field">
                            <span class="absolute start-4 top-1/2 -translate-y-1/2 pointer-events-none flex text-xl">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control h-[56px] ps-11 border-neutral-300 bg-neutral-50 dark:bg-dark-2 rounded-xl" placeholder="Ketik Ulang Kata Sandi">
                        </div>
                        <span class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light" data-toggle="#confirm_password"></span>
                    </div>
                    <button type="submit" class="btn btn-primary justify-center text-sm btn-sm px-3 py-4 w-full rounded-xl"> Perbaharui Kata Sandi</button>

                    <div class="text-center">
                        <a href="{{ route('auth.login') }}" class="text-primary-600 font-bold mt-6 hover:underline">Kembali ke Halaman Masuk</a>
                    </div>

                </form>
            </div>
        </div>
    </section>

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
