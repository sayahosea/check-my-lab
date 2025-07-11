<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kelola Akun Pegawai</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <x-sidebar.medis></x-sidebar.medis>

    <!-- Main content area -->
    <div class="ml-60 min-h-screen">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        @if(session('alert_msg'))
            <div class="toast toast-top toast-center">
                <div class="alert {{ session('alert_color') }}">
                    <span>{{ session('alert_msg') }}</span>
                </div>
            </div>
        @endif

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100">

                <h1 class="text-2xl font-bold text-black mb-4">Kelola Akun Pegawai</h1>
                <div class="bg-white shadow rounded p-4">

                    <div class="max-w-4xl">

                        <div class="flex items-center mb-6">

                            <!-- Tombol Tambah Pasien -->
                            <a
                                onclick="create_acc_modal.showModal()"
                                class="btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Buat Akun
                            </a>

                                <!-- Open the modal using ID.showModal() method -->
                                <dialog id="create_acc_modal" class="modal">
                                    <div class="modal-box">
                                        <h3 class="text-lg font-bold text-center mb-6">Buat Akun Pegawai</h3>

                                        <form action="{{ url('/staffs/create') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                                            @csrf
                                            <fieldset class="fieldset">
                                                <legend class="fieldset-legend">Nama Lengkap</legend>
                                                <input
                                                    name="full_name" minlength="3" maxlength="60"
                                                    type="text" class="input"
                                                    required />
                                            </fieldset>
                                            <fieldset class="fieldset">
                                                <legend class="fieldset-legend">Nomor Telepon</legend>
                                                <input
                                                    name="phone_number"
                                                    type="tel" placeholder="08....." class="input"
                                                    minlength="10" maxlength="15" pattern="^08\d{8,15}$"
                                                    required />
                                            </fieldset>
                                            <fieldset class="fieldset">
                                                <legend class="fieldset-legend">Kata Sandi</legend>
                                                <input
                                                    name="password" type="password" minlength="5"
                                                    maxlength="32" class="input"
                                                    required />
                                            </fieldset>
                                            <fieldset class="fieldset">
                                                <legend class="fieldset-legend">Peran</legend>
                                                <select class="select" name="role" required>
                                                    <option value="MEDIS">Tim Rekam Medis</option>
                                                    <option value="LAB">Laboran</option>
                                                </select>
                                            </fieldset>
                                            <input type="submit" class="btn btn-info btn-block mt-2" value="Kirim">
                                        </form>
                                        <button class="btn btn-error btn-block mt-2"  onclick="create_acc_modal.close()">Batal</button>
                                    </div>
                                </dialog>

                        </div>

                        <div class="max-w-4xl mx-auto">

                            @if(count($staffs) > 0)
                            <div class="overflow-x-auto">
                                <!-- List of patients -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>Nomor Telepon</th>
                                        <th>Peran</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($staffs as $staff)
                                        <tr>
                                            <td>{{ $staff->full_name }}</td>
                                            <td>{{ $staff->phone_number }}</td>
                                            <td>{{ $staff->role }}</td>
                                            <td>
                                                <a href="/staffs/edit/{{ $staff->account_id }}">
                                                    <button class="btn btn-info">Ubah</button>
                                                </a>
                                                <a href="/staffs/delete/{{ $staff->account_id }}">
                                                    <button class="btn btn-error">Hapus</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <p>Belum ada akun pegawai puskesmas</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
