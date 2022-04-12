require("./bootstrap");

import Alpine from 'alpinejs'
import "flag-icon-css/css/flag-icon.css";
import bsCustomFileInput from "bs-custom-file-input";
import "lazysizes";
import "jquery-ui/ui/widgets/sortable";

Alpine.start();

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    bsCustomFileInput.init();
});
