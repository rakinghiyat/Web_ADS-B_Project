<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data ADS-B</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('maps/simpanData', ['class' => 'formData']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label for="groundStation" class="">Ground Station</label>
                    <input type="text" name="groundStation" class="form-control" id="groundStation">
                    <div class="invalid-feedback errorGS">

                    </div>
                </div>
                <div class="form-group">
                    <label for="sic class="">SIC</label>
                    <input type=" text" name="sic" class="form-control" id="sic">
                        <div class="invalid-feedback errorSic">

                        </div>
                </div>
                <div class="form-group">
                    <label for="sac" class="">SAC</label>
                    <input type="text" name="sac" class="form-control" id="sac">
                    <div class="invalid-feedback errorSac">

                    </div>
                </div>
                <div class="form-group">
                    <label for="altitude" class="">Altitude</label>
                    <input type="text" name="altitude" class="form-control" id="altitude">
                </div>
                <div class="form-group">
                    <label for="latitude" class="">Latitude</label>
                    <input type="text" name="latitude" class="form-control" id="latitude">
                    <div class="invalid-feedback errorLat">

                    </div>
                </div>
                <div class="form-group">
                    <label for="longitude" class="">Longitude</label>
                    <input type="text" name="longitude" class="form-control" id="longitude">
                    <div class="invalid-feedback errorLong">

                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal" class="">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal">
                </div>
                <div class="form-group">
                    <label for="waktu" class="">Waktu</label>
                    <input type="text" name="waktu" class="form-control" id="waktu">
                </div>
                <div class="form-group">
                    <label for="stts" class="">Status</label>
                    <select name="stts" class="form-control form-control-sm" id="stts">
                        <option value="Data Loading..">Pilih..</option>
                        <option value="OK">OK</option>
                        <option value="OFF">OFF</option>
                        <option value="FAIL">FAIL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan" class="">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control form-control-sm" id="keterangan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
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
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.groundStation) {
                            $('#groundStation').addClass('is-invalid');
                            $('.errorGS').html(response.error.groundStation);
                        } else {
                            $('#groundStation').removeClass('is-invalid');
                            $('.errorGS').html('');
                        }

                        if (response.error.sic) {
                            $('#sic').addClass('is-invalid');
                            $('.errorSic').html(response.error.sic);
                        } else {
                            $('#sic').removeClass('is-invalid');
                            $('.errorSic').html('');
                        }
                        if (response.error.sac) {
                            $('#sac').addClass('is-invalid');
                            $('.errorSac').html(response.error.sac);
                        } else {
                            $('#sac').removeClass('is-invalid');
                            $('.errorSac').html('');
                        }
                        if (response.error.latitude) {
                            $('#latitude').addClass('is-invalid');
                            $('.errorLat').html(response.error.latitude);
                        } else {
                            $('#latitude').removeClass('is-invalid');
                            $('.errorLat').html('');
                        }
                        if (response.error.longitude) {
                            $('#longitude').addClass('is-invalid');
                            $('.errorLong').html(response.error.longitude);
                        } else {
                            $('#longitude').removeClass('is-invalid');
                            $('.errorLong').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses
                        })

                        $('#modalTambah').modal('hide');
                        data();
                    }
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