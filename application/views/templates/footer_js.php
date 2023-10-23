<!-- Plugin js for this page -->
<script src="<?= base_url('assets'); ?>/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->

<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- akhir bootstrap js -->

<!-- inject:js -->
<script src="<?= base_url('assets'); ?>/js/off-canvas.js"></script>
<script src="<?= base_url('assets'); ?>/js/hoverable-collapse.js"></script>
<script src="<?= base_url('assets'); ?>/js/template.js"></script>
<script src="<?= base_url('assets'); ?>/js/settings.js"></script>
<script src="<?= base_url('assets'); ?>/js/todolist.js"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="<?= base_url('assets'); ?>/vendors/select2/select2.min.js"></script>
<!-- End plugin js for this page -->

<!-- Custom js for this page-->
<script src="<?= base_url('assets'); ?>/js/dashboard.js"></script>
<script src="<?= base_url('assets'); ?>/js/Chart.roundedBarCharts.js"></script>
<script src="<?= base_url('assets'); ?>/js/file-upload.js"></script>
<script src="<?= base_url('assets'); ?>/js/script.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.3/gsap.min.js'></script>
<!-- End custom js for this page-->

<script>
document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>
<script>
$(function() {
    $('#datepicker-popup').datepicker();
});
</script>

</body>

</html>