<div class="col-sm-12 mt-3">
    <div class="card m-b-30">
        <h4 class="card-header mt-0">Maps</h4>
        <div class="card-body">
            <p class="card-text viewMaps">
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLHdoWey-cwIO1xUeoVHndtVZyKT12NA&callback=initMap&v=3.31">
                </script>
                <script>
                    function initMap() {


                        var propertiPeta = {
                            center: new google.maps.LatLng(-2.989247, 117.488906),
                            zoom: 5,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };

                        var peta = new google.maps.Map(document.getElementById("map-canvas"), propertiPeta);

                        var locations = [
                            <?php foreach ($tampildata as $key) : ?> {
                                    lat: <?= $key['latitude'] ?>,
                                    lng: <?= $key['longitude'] ?>,
                                    gs: "<?= $key['groundStation'] ?>",
                                    sic: "SIC/SAC : <?= $key['sic'] ?>/",
                                    sac: "<?= $key['sac']; ?>",
                                    tanggal: "tanggal : <?= $key['tanggal']; ?>",
                                    waktu: "waktu : <?= $key['waktu']; ?>",
                                    status: "status : <?= $key['status']; ?>",
                                    keterangan: "keterangan : <?= $key['keterangan']; ?>",
                                    time_update: "time update : <?= $key['time_update']; ?>",
                                },
                            <?php endforeach; ?>
                        ];

                        locations.forEach(function(loc) {
                            icon = ''
                            if (loc.status === 'status : OK') {
                                icon = '/assets/images/maps/OK.png'
                            } else {
                                icon = '/assets/images/maps/OFF.png'
                            }

                            var marker = new google.maps.Marker({
                                position: loc,
                                map: peta,
                                // title: loc.title
                                icon: icon
                            });




                            var infowindow = new google.maps.InfoWindow({
                                content: "<div style=\"overflow:auto; font-size:13px; width: 150px;\"><b style='font-size:15px'>" +
                                    loc.gs + "</b><br>" + loc.sic + loc.sac + "<br>" + loc.tanggal + "<br>" + loc.waktu + "<br>" + loc.status + "<br>" + loc.keterangan + "<br>" + loc.time_update + "</div>"
                            });
                            google.maps.event.addListener(marker, 'click', function() {
                                infowindow.open(peta, marker);
                            });
                        });

                    }
                </script>
            <div id="map-canvas" style="height: 600px;"></div>

            <script>

            </script>
            </p>
        </div>
    </div>
</div>


<div class="col-sm-12">
    <div class="card m-b-30">
        <h4 class="card-header mt-0">Data ADS-B</h4>
        <div class="card-title">
            <button type="button" class="btn btn-primary btn-sm tombolTambah ml-4 mt-4">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </button>
            <button type="button" class="btn btn-info btn-sm tombolTambahBanyak ml-2 mt-4">
                <i class="fa fa-plus-circle"></i> Tambah Data Banyak
            </button>
        </div>
        <div class="card-body">
            <?= form_open('maps/hapusBanyak', ['class' => 'formHapusBanyak']) ?>
            <p>
                <button type="submit" class="btn btn-danger btn-sm ml-1 mb-1">
                    <i class="fa fa-trash-o"></i> Hapus Banyak
                </button>
            </p>
            <table class="table table-sm table-striped" id="dataTables">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="centangSemua">
                        </th>
                        <th>No.</th>
                        <th>Ground Station</th>
                        <th>SIC/SAC</th>
                        <th>Altitude</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Time Update</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($tampildata as $key) : ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="id[]" class="centangId" value="<?= $key['id']; ?>">
                            </td>
                            <td><?= $i++; ?></td>
                            <td><?= $key['groundStation']; ?></td>
                            <td><?= $key['sic']; ?>/<?= $key['sac']; ?></td>
                            <td><?= $key['altitude']; ?></td>
                            <td><?= $key['latitude']; ?></td>
                            <td><?= $key['longitude']; ?></td>
                            <td><?= $key['tanggal']; ?></td>
                            <td><?= $key['waktu']; ?></td>
                            <td><?= $key['status']; ?></td>
                            <td><?= $key['keterangan']; ?></td>
                            <td><?= $key['time_update']; ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $key['id']; ?>')">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $key['id']; ?>')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTables').DataTable();

        $('#centangSemua').click(function(e) {

            if ($(this).is(':checked')) {
                $('.centangId').prop('checked', true);
            } else {
                $('.centangId').prop('checked', false);
            }
        });

        $('.formHapusBanyak').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangId:checked');

            if (jmldata.length === 0) {

                Swal.fire({
                    icon: 'error',
                    title: 'Perhatian',
                    text: 'Maaf silahkan pilih data yang mau dihapus !'
                });

            } else {

                Swal.fire({
                    title: 'Hapus Data Banyak',
                    text: `Yakin menghapus ${jmldata.length} data ?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.sukses) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.sukses
                                    });
                                    data();
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                console.log(xhr.status + "\n" + xhr.responseText + "\n" +
                                    thrownError);
                            }
                        });
                    }


                })

            }
            return false;
        });

    });

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('maps/formEdit'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus',
            text: `Yakin menghapus data ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('maps/hapus') ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                            data();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status + "\n" + xhr.responseText + "\n" +
                            thrownError);
                    }
                });
            }
        })
    }
</script>