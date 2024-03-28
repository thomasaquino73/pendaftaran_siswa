<div class="sidebar-overlay" data-reff=""></div>
{{-- <script src="{{ asset('') }}assets/js/jquery-3.2.1.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="{{ asset('') }}assets/js/popper.min.js"></script>
<script src="{{ asset('') }}assets/js/bootstrap.min.js"></script>
<script src="{{ asset('') }}assets/js/jquery.slimscroll.js"></script>
{{-- <script src="{{ asset('') }}assets/js/Chart.bundle.js"></script>
<script src="{{ asset('') }}assets/js/chart.js"></script> --}}
<script src="{{ asset('') }}assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('') }}assets/js/moment.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script> --}}

{{-- tambahan --}}
<script src="{{ asset('') }}assets/js/datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('') }}assets/bundles/izitoast/js/iziToast.min.js"></script>
<script src="{{ asset('') }}assets/bundles/sweetalert/sweetalert.min.js"></script>

<style>
    .form-control:focus {
        border-color: #000;
    }

    .form-control {
        border-color: #63b4ff;
    }

    .lejen {
        border-bottom: 2px dashed silver;
    }

    .devider {
        width: 100%;
        height: 1px;
        background: #bbb;
        margin: 1rem 0;
    }
/* checkbox */
    .checkbox-wrapper-2 .ikxBAC {
         appearance: none;
         background-color: #dfe1e4;
         border-radius: 72px;
         border-style: none;
         flex-shrink: 0;
         height: 20px;
         margin: 0;
         position: relative;
         width: 30px;
     }

     .checkbox-wrapper-2 .ikxBAC::before {
         bottom: -6px;
         content: "";
         left: -6px;
         position: absolute;
         right: -6px;
         top: -6px;
     }

     .checkbox-wrapper-2 .ikxBAC,
     .checkbox-wrapper-2 .ikxBAC::after {
         transition: all 100ms ease-out;
     }

     .checkbox-wrapper-2 .ikxBAC::after {
         background-color: #fff;
         border-radius: 50%;
         content: "";
         height: 14px;
         left: 3px;
         position: absolute;
         top: 3px;
         width: 14px;
     }

     .checkbox-wrapper-2 input[type=checkbox] {
         cursor: default;
     }

     .checkbox-wrapper-2 .ikxBAC:hover {
         background-color: #c9cbcd;
         transition-duration: 0s;
     }

     .checkbox-wrapper-2 .ikxBAC:checked {
         background-color: #6e79d6;
     }

     .checkbox-wrapper-2 .ikxBAC:checked::after {
         background-color: #fff;
         left: 13px;
     }

     .checkbox-wrapper-2 :focus:not(.focus-visible) {
         outline: 0;
     }

     .checkbox-wrapper-2 .ikxBAC:checked:hover {
         background-color: #535db3;
     }
 </style>
<script>
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            minimumInputLength: 1,
            // allowClear: true,
        });
    });

    $('.single-select-field2').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        // allowClear: true,
    });
    $('.single-select-field1').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        minimumInputLength: 1,
        // allowClear: true,
    });
    $('.info').select2();
</script>
@stack('scripts')
