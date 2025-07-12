<dialog id="edit_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold text-center mb-6">Ubah Virus</h3>

        <form action="{{ url('/outbreak/virus/edit') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            <fieldset class="fieldset hidden">
                <legend class="fieldset-legend">ID Virus</legend>
                <input
                    name="id" id="id"
                    type="number" class="input" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama Virus</legend>
                <input
                    name="name" id="name" minlength="3" maxlength="64"
                    type="text" class="input" required />
            </fieldset>
            <input type="submit" class="btn btn-info btn-block mt-2" value="Kirim">
        </form>

        <button class="btn btn-error btn-block mt-2" onclick="edit_modal.close()">Batal</button>
    </div>
</dialog>
