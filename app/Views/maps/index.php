<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- <div class="col-sm-12">
    <div class="page-title-box">
        <h2 class="page-title">ADS-B Status Monitoring</h2>
    </div>
</div> -->

<div class="col-sm-12">
    <p class="card-text viewData">

    </p>
</div>
<div class="viewModal" style="display: none;"></div>
<script>
    function data() {
        $.ajax({
            url: "<?= site_url('maps/ambilData') ?>",
            dataType: "json",
            success: function(response) {

                $('.viewData').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // alert(xhr.status + "\n" + xhr.responseText + "\n" +
                //     thrownError);
                console.log(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    $(document).ready(function() {
        data();

        $('.tombolTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('maps/formTambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewModal').html(response.data).show();

                    $('#modalTambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" +
                        thrownError);
                }
            });
        });

        $('.tombolTambahBanyak').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('maps/formTambahBanyak') ?>",
                dataType: "json",
                beforeSend: function() {
                    $('.viewData').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    $('.viewData').html(response.data).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" +
                        thrownError);
                }
            });
        });
    });
</script>

<?= $this->endSection('') ?>