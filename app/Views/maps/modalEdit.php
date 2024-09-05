<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data ADS-B</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('maps/updateData', ['class' => 'formData']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="hidden" name="id_input_data" value="<?= $id_input_data; ?>">
                <div class="form-group">
                    <label for="groundStation" class="">Ground Station</label>
                    <input type="text" name="groundStation" class="form-control" id="groundStation" value="<?= $groundStation; ?>">
                </div>
                <div class="form-group">
                    <label for="sic class=">SIC</label>
                    <input type=" text" name="sic" class="form-control" id="sic" value="<?= $sic; ?>">
                </div>
                <div class="form-group">
                    <label for="sac" class="">SAC</label>
                    <input type="text" name="sac" class="form-control" id="sac" value="<?= $sac; ?>">
                </div>
                <div class="form-group">
                    <label for="altitude" class="">Altitude</label>
                    <input type="text" name="altitude" class="form-control" id="altitude" value="<?= $altitude; ?>">
                </div>
                <div class="form-group">
                    <label for="latitude" class="">Latitude</label>
                    <input type="text" name="latitude" class="form-control" id="latitude" value="<?= $latitude; ?>">
                </div>
                <div class="form-group">
                    <label for="longitude" class="">Longitude</label>
                    <input type="text" name="longitude" class="form-control" id="longitude" value="<?= $longitude; ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal" class="">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= $tanggal; ?>">
                </div>
                <div class="form-group">
                    <label for="waktu" class="">Waktu</label>
                    <input type="text" name="waktu" class="form-control" id="waktu" value="<?= $waktu; ?>">
                </div>
                <div class="form-group">
                    <label for="stts" class="">Status</label>
                    <select name="stts" class="form-control form-control-sm" id="stts" value="<?= $status; ?>">
                        <option value="Data Loading" <?php if ($status == '') echo "selected"; ?>>Data Loading..</option>
                        <option value="OK" <?php if ($status == 'OK') echo "selected"; ?>>OK</option>
                        <option value="OFF" <?php if ($status == 'OFF') echo "selected"; ?>>OFF</option>
                        <option value="FAIL" <?php if ($status == 'FAIL') echo "selected"; ?>>FAIL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan" class="">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control form-control-sm" id="keterangan" value="<?= $keterangan; ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnSimpan">Update</button>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.formData').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnSimpan').attr('disable', 'disabled');
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disable');
                    $('.btnSimpan').html('Update');
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses
                    })

                    $('#modalEdit').modal('hide');
                    data();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" +
                        thrownError);
                }
            });
            return false;
        });
    });
</script>