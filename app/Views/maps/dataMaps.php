<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLHdoWey-cwIO1xUeoVHndtVZyKT12NA&callback=initMap&v=3.31">
</script>

<div id="map-canvas" style="height: 600px;"></div>

<script>
    function initMap() {
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

                },
            <?php endforeach; ?>
        ];

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 5,
            center: {
                lat: -2.989247,
                lng: 117.488906
            }

        });

        locations.forEach(function(loc) {
            var marker = new google.maps.Marker({
                position: loc,
                map: map,
                // title: loc.title
                icon: '/img/On.png'


            });
            var infowindow = new google.maps.InfoWindow({
                content: "<div style=\"overflow:auto; font-size:13px; width: 150px;\"><b style='font-size:15px'>" +
                    loc.gs + "</b><br>" + loc.sic + loc.sac + "<br>" + loc.tanggal + "<br>" + loc.waktu + "<br>" + loc.status + "<br>" + loc.keterangan + "</div>"
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
        });

    }
</script>