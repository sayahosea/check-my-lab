<dialog id="edit_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold text-center mb-6">Edit Daerah</h3>

        <form action="{{ url('/outbreak/region/edit') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            <fieldset class="fieldset hidden">
                <legend class="fieldset-legend">ID Daerah</legend>
                <input
                    name="id" id="id"
                    type="number" class="input" readonly required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama Daerah</legend>
                <input
                    name="name" id="name_edit" minlength="3" maxlength="64"
                    type="text" class="input" required />
            </fieldset>
            <fieldset class="fieldset">
                <table>
                    <tr>
                        <td>
                            <div id="map" style="height: 30vh;"></div>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Latitude</legend>
                <input
                    name="latitude" id="lat_edit"
                    type="number" class="input" readonly required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Longitude</legend>
                <input
                    name="longitude" id="lng_edit"
                    type="number" class="input" readonly required />
            </fieldset>
            <input type="submit" class="btn btn-info btn-block mt-2" value="Kirim">
        </form>
        <button class="btn btn-error btn-block mt-2"  onclick="edit_modal.close()">Batal</button>
    </div>
</dialog>
