<dialog id="add_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold text-center mb-6">Tambah Virus</h3>

        <form action="{{ url('/outbreak/virus/add') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama Virus</legend>
                <input
                    name="name" minlength="3" maxlength="64"
                    type="text" class="input" required />
            </fieldset>
            <input type="submit" class="btn btn-info btn-block mt-2" value="Kirim">
        </form>

        <button class="btn btn-error btn-block mt-2"  onclick="add_modal.close()">Batal</button>
    </div>
</dialog>
