<header class="flex justify-end items-center bg-white shadow px-5 py-3 ">
    <div class="flex items-center gap-4">
        <div class="sm:flex sm:gap-4">
            <x-button
                color="bg-[#a8dadc]"
                hover="hover:bg-[#7cbac0]"
                text="Keluar Akun"
                url="{{ route('logout') }}"
            ></x-button>
        </div>
    </div>
</header>
