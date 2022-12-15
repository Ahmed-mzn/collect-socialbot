



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Internal Select2 css -->
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet">
</head>
<body>

    <br><br>
    <div class="container">
        <div class="form-group">
            <label class="form-label">Customize Select</label>
            <select name="country" class="form-control form-select select2" data-bs-placeholder="Select Country" readonly>
                <option value="br">Brazil</option>
                <option value="cz">Czech Republic</option>
                <option value="de">Germany</option>
                <option value="pl" selected>Poland</option>
            </select>
        </div>
    </div>

    <!-- SELECT2 JS -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2').select2();
});
    </script>
</body>
</html>