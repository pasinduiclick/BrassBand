<script>
// Global JS variables
    var csrf_token = "<?php echo $clib->get_csrf_token(TRUE) ?>";
</script>
<!-- plugins:js -->
<script src="../Common/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js -->
<script src="../Common/assets/vendors/chart.js/Chart.min.js"></script>
<script src="../Common/assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../Common/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<script src="../Common/assets/vendors/dataTablesImport/dataTables.buttons.min.js" ></script>
<script src="../Common/assets/vendors/dataTablesImport/buttons.flash.min.js" ></script>
<script src="../Common/assets/vendors/dataTablesImport/jszip.min.js" ></script>
<script src="../Common/assets/vendors/dataTablesImport/pdfmake.min.js" ></script>
<script src="../Common/assets/vendors/dataTablesImport/vfs_fonts.js" ></script>
<script src="../Common/assets/vendors/dataTablesImport/buttons.html5.min.js" ></script>
<script src="../Common/assets/vendors/dataTablesImport/buttons.print.min.js" ></script>

<script src="../Common/assets/vendors/jquery-validation/jquery.validate.min.js"></script>
<script src="../Common/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="../Common/assets/vendors/sweetalert/sweetalert.min.js"></script>
<script src="../Common/assets/vendors/jquery.avgrund/jquery.avgrund.min.js"></script>
<script src="../Common/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="../Common/assets/vendors/select2/select2.min.js"></script>
<script src="../Common/assets/vendors/jquery-steps/jquery.steps.min.js"></script>
<script src="../Common/assets/vendors/jquery-file-upload/jquery.uploadfile.min.js"></script>
<script src="../Common/assets/vendors/dropzone/dropzone.js"></script>
<script src="../Common/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="../Common/assets/vendors/summernote/dist/summernote-bs4.min.js"></script>
<!-- End plugin js -->
<!-- inject:js -->
<script src="../Common/assets/js/off-canvas.js"></script>
<script src="../Common/assets/js/hoverable-collapse.js"></script>
<script src="../Common/assets/js/template.js"></script>
<script src="../Common/assets/js/settings.js"></script>
<script src="../Common/assets/js/todolist.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAasaVcaRWLtVjpF7z7DY0ZOlZojv4vbiM&libraries=places&callback=initAutocomplete"
async defer></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../Common/assets/js/dashboard.js"></script>
<script src="../Common/assets/js/chart.js"></script>
<script src="../Common/assets/js/wizard.js"></script>
<script src="../Sales/js/calculations.js"></script>
<script>
    if (document.getElementById('fileupload')) {
        var myDropzone = new Dropzone("div#fileupload", {url: "../../Services/QuotationService.php", paramName: "attacht"});
        myDropzone.on("success", function (file, response) {
            var node = document.getElementById('fileupload');

            var input = document.createElement("input");

            input.setAttribute("type", "hidden");

            input.setAttribute("name", "imgids[]");

            input.setAttribute("value", response);

            document.getElementById("attachments").appendChild(input);

        });
    }

    if (document.getElementById('fileupload2')) {
        var myDropzone2 = new Dropzone("div#fileupload2", {url: "../../Services/OrderService.php", paramName: "attacht"});
        myDropzone2.on('sending', function (file, xhr, formData) {
            formData.append('serviceFlag', 'UPDATEART');
            formData.append('order_number', document.getElementById('ordernum').value);
        });
        myDropzone2.on("success", function (file, response) {
            var res = JSON.parse(response);
            console.log(res);
            $("#artwod").append('<div class="col-md-6 col-lg-6" style="border-right: 1px solid silver;" ><li class="fa fa-close" style="color: red;float: right; cursor: pointer;" picid="' + res["id"] + '" ></li><a href="../../Services/' + res["pic"] + '" target="blank"><img style="width: 100%;" src="../../Services/' + res["pic"] + '" /></a></div>');
        });
    }

    var autocomplete, autocomplete2;


    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types..
        // console.log(document.getElementById('autocomplete').value);

        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});


        autocomplete.setComponentRestrictions(
                {'country': ['nz', 'au']});



        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }


    function fillInAddress() {
        var place;
        place = autocomplete.getPlace();

        var str = document.getElementById("autocomplete").value;

        document.getElementById("autocomplete").value = str;
        document.getElementById("lat").value = place.geometry.location.lat();
        document.getElementById("lon").value = place.geometry.location.lng();

    }
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                //autocomplete.setBounds(circle.getBounds());
            });


        }
    }


    $(document).ready(function () {
        var alert = setInterval(function () {
            $(".alert").alert('close');
            clearInterval(alert);
        }, 3000);

        $(".select2").select2({
            placeholder: $(".select2").attr("placeholder"),
            allowClear: true});

        if ($("#datepicker-popup,#datepicker-popup2").length) {
            $('#datepicker-popup,#datepicker-popup2').datepicker({
                enableOnReadonly: true,
                todayHighlight: true,
                format: "yyyy-mm-dd"
            });
        }

        if ($(".summernote").length) {
            $('.summernote').summernote({
                height: 300,
                tabsize: 2
            });
        }

    });

    (function ($) {
        'use strict';
        $(function () {
            $('.datatable').DataTable();
            $('.datatableprint').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $('.table').each(function () {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });



            /* Code for attribute data-custom-class for adding custom class to tooltip */
            if (typeof $.fn.tooltip.Constructor === 'undefined') {
                throw new Error('Bootstrap Tooltip must be included first!');
            }

            var Tooltip = $.fn.tooltip.Constructor;

            // add customClass option to Bootstrap Tooltip
            $.extend(Tooltip.Default, {
                customClass: ''
            });

            var _show = Tooltip.prototype.show;

            Tooltip.prototype.show = function () {

                // invoke parent method
                _show.apply(this, Array.prototype.slice.apply(arguments));

                if (this.config.customClass) {
                    var tip = this.getTipElement();
                    $(tip).addClass(this.config.customClass);
                }

            };
            $('[data-toggle="tooltip"]').tooltip();



            // validate the comment form when it is submitted
            $("#commentForm").validate({
                errorPlacement: function (label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
                highlight: function (element, errorClass) {
                    $(element).parent().addClass('has-danger');
                    $(element).addClass('form-control-danger');
                }
            });

            $("#signupForm").validate({
                rules: {
                    firstname: "required",
                    username: {
                        required: true,
                        minlength: 2
                    },
                    password: {

                        minlength: 5
                    },
                    confirm_password: {

                        minlength: 5,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    }

                },
                messages: {
                    firstname: "Please enter your firstname",
                    username: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 2 characters"
                    },
                    password: {

                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {

                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    email: "Please enter a valid email address"

                },
                errorPlacement: function (label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
                highlight: function (element, errorClass) {
                    $(element).parent().addClass('has-danger')
                    $(element).addClass('form-control-danger')
                }
            });


        });




    })(jQuery);

    (function ($) {
        showSwal = function (type, url) {
            'use strict';

            if (type === 'basic') {
                swal({
                    text: 'Any fool can use a computer',
                    button: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                    }
                })

            } else if (type === 'title-and-text') {
                swal({
                    title: 'Read the alert!',
                    text: 'Click OK to close this alert',
                    button: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                    }
                })

            } else if (type === 'success-message') {
                swal({
                    title: 'Congratulations!',
                    text: 'You entered the correct answer',
                    icon: 'success',
                    button: {
                        text: "Continue",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                    }
                })

            } else if (type === 'auto-close') {
                swal({
                    title: 'Auto close alert!',
                    text: 'I will close in 2 seconds.',
                    timer: 2000,
                    button: false
                }).then(
                        function () {},
                        // handling the promise rejection
                                function (dismiss) {
                                    if (dismiss === 'timer') {
                                        console.log('I was closed by the timer')
                                    }
                                }
                        )
                    } else if (type === 'warning-message-and-cancel') {
                swal({
                    title: 'Please Confirm this Action!',
                    text: "These Changes will be directly applied to the Database without any further filtering.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3f51b5',
                    cancelButtonColor: '#ff4081',
                    confirmButtonText: 'Great ',
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            value: null,
                            visible: true,
                            className: "btn btn-inverse-danger btn-fw",
                            closeModal: true,
                        },
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "btn btn-inverse-primary btn-fw",
                            closeModal: true
                        }
                    }

                }).then(function (isConfrim) {
                    if (isConfrim) {
                        window.location.href = url;
                    }

                });

            } else if (type === 'custom-html') {
                swal({
                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "Type your password",
                            type: "password",
                            class: 'form-control'
                        },
                    },
                    button: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                    }
                })
            }
        }

    })(jQuery);




</script>
<!-- End custom js for this page-->

</body>

</html>