<dialog id="add_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold text-center mb-6">Tambah Daerah</h3>

        <form action="{{ url('/outbreak/region/add') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama Daerah</legend>
                <input
                    name="name" minlength="3" maxlength="64"
                    type="text" class="input" required />
            </fieldset>
            <fieldset class="fieldset">
                <table>
                    <tr>
                        <td>
                            <div id="map2" style="height: 30vh;"></div>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Latitude</legend>
                <input
                    name="latitude"
                    type="number" class="input" readonly required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Longitude</legend>
                <input
                    name="longitude"
                    type="number" class="input" readonly required />
            </fieldset>
            <input type="submit" class="btn btn-info btn-block mt-2" value="Kirim">
        </form>
        <button class="btn btn-error btn-block mt-2"  onclick="add_modal.close()">Batal</button>
    </div>
</dialog>
