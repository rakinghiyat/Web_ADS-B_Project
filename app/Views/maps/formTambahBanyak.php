<?= form_open('maps/simpanDataBanyak', ['class' => 'formSimpanBanyak']) ?>
<?= csrf_field(); ?>
<p>
    <button type="button" class="btn btn-warning btnKembali">
        Kembali
    </button>

    <button type="submit" class="btn btn-primary btnSimpanBanyak ml-1">
        Simpan Data
    </button>
</p>
<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>Ground Station</th>
            <th>SIC</th>
            <th>SAC</th>
            <th>Altitude</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>#</th>
        </tr>
    </thead>

    <tbody class="formTambah">
        <tr>
            <input type="hidden" name="id">
            <td>
                <input type="text" name="groundStation[]" class="form-control">
            </td>
            <td>
                <input type="text" name="sic[]" class="form-control">
            </td>
            <td>
                <input type="text" name="sac[]" class="form-control">
            </td>
            <td>
                <input type="text" name="altitude[]" class="form-control">
            </td>
            <td>
                <input type="text" name="latitude[]" class="form-control">
            </td>
            <td>
                <input type="text" name="longitude[]" class="form-control">
            </td>
            <td>
                <input type="date" name="tanggal[]" class="form-control">
            </td>
            <td>
                <input type="text" name="waktu[]" class="form-control">
            </td>
            <td>
                <select name="stts[]" class="form-control">
                    <option value="Data Loading..">Pilih..</option>
                    <option value="OK">OK</option>
                    <option value="OFF">OFF</option>
                    <option value="FAIL">FAIL</option>
                </select>
            </td>
            <td>
                <input type="text" name="keterangan[]" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-primary btnAddForm">
                    <i class="fa fa-plus"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>
<?= form_close(); ?>
<script>
    $(document).ready(function(e) {

        $('.formSimpanBanyak').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnSimpanBanyak').attr('disable', 'disabled');
                    $('.btnSimpanBanyak').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpanBanyak').removeAttr('disable');
                    $('.btnSimpanBanyak').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `${response.sukses}`,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = (
                                    "<?= site_url('maps/index') ?>");
                            }
                        });

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" +
                        thrownError);
                }
            });
            return false;
        });

        $('.btnAddForm').click(function(e) {
            e.preventDefault();

            $('.formTambah').append(`
        <tr>
            <td>
                <input type="text" name="groundStation[]" class="form-control">
            </td>
            <td>
                <input type="text" name="sic[]" class="form-control">
            </td>
            <td>
                <input type="text" name="sac[]" class="form-control">
            </td>
            <td>
                <input type="text" name="altitude[]" class="form-control">
            </td>
            <td>
                <input type="text" name="latitude[]" class="form-control">
            </td>
            <td>
                <input type="text" name="longitude[]" class="form-control">
            </td>
            <td>
                <input type="date" name="tanggal[]" class="form-control">
            </td>
            <td>
                <input type="text" name="waktu[]" class="form-control">
            </td>
            <td>
                <select name="stts[]" class="form-control">
                    <option value="Data Loading..">Pilih..</option>
                    <option value="OK">OK</option>
                    <option value="OFF">OFF</option>
                    <option value="FAIL">FAIL</option>
                </select>
            </td>
            <td>
                <input type="text" name="keterangan[]" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-danger btnHapusForm">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        `);
        });
        $('.btnKembali').click(function(e) {
            e.preventDefault();
            data();
        });
    });

    $(document).on('click', '.btnHapusForm', function(e) {
        e.preventDefault();

        $(this).parents('tr').remove();
    });
</script>