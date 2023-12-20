<?php
$dt = isset($dataTable)?$dataTable:null;
?>
@if($dt)

    <div class="card-datatable table-responsive">
        <table id="{{ $dt->tableId() }}" class="dt-fixedheader table table-{{ $dt->tableId() }}{{ $dt->tableId() }}">
            <thead>
            <tr>
                @foreach($dt->cols() as $key=>$col)
                    <th class="col-{{$key}}">{{$col['title']}}</th>
                @endforeach
            </tr>
            </thead>
        </table>
    </div>
    @section('dataTable-script')
        <script>
            $(document).ready(function(){
                let args = {
                    searching: true,
                    columns               : [@foreach($dt->cols() as $key => $col){data: "{{$key}}"},@endforeach],
                    columnDefs            : [
                            @php $int=0;@endphp
                            @foreach($dt->cols() as $key => $col){
                            targets  : [{{$int++}}],
                            className: "{{$col["className"]}}",
                            orderable: !!{{intval($col["orderable"])}},
                        },@endforeach],
                    ajax_url: '{{$dt->url()}}',
                    /*ajax_data: function(d){
                        if($('.datatable-filer').length){
                            $('.datatable-filer').each(function(){
                                console.log(d);
                            });
                        }
                    },*/
                    ajax_success : function(json){
                        return json.data;
                    },
                    initComplete : function () {
                    },
                };
                createDataTable($('#{{ $dt->tableId() }}'), args);
                function createDataTable(elem, args) {
                    if (elem.length) {
                        table = elem.DataTable({
                            columns: args.columns,
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: '{{$dt->url()}}',
                                data: function (d) {
                                    d['where'] = {};
                                    if($('.datatable-filter').length){
                                        $('.datatable-filter').each(function(){
                                            if (typeof $(this).attr('name') !== "undefined") {
                                                d['where'][$(this).attr('name')] = $(this).val();
                                            }
                                        });
                                    }
                                }
                            },
                            lengthMenu: [[25, 50, 100], [25, 50, 100]],
                            initComplete: function () {

                            },
                            /*dom:
                                '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                                '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
                                '>t' +
                                '<"d-flex justify-content-between mx-2 row mb-1"' +
                                '<"col-sm-12 col-md-6"i>' +
                                '<"col-sm-12 col-md-6"p>' +
                                '>',
                            buttons: [
                                {
                                    extend: 'collection',
                                    className: 'btn btn-outline-secondary dropdown-toggle me-2',
                                    text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                                    buttons: [
                                        {
                                            extend: 'print',
                                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                                            className: 'dropdown-item',
                                            exportOptions: { columns: [1, 2, 3, 4, 5] }
                                        },
                                        {
                                            extend: 'csv',
                                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                                            className: 'dropdown-item',
                                            exportOptions: { columns: [1, 2, 3, 4, 5] }
                                        },
                                        {
                                            extend: 'excel',
                                            text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                                            className: 'dropdown-item',
                                            exportOptions: { columns: [1, 2, 3, 4, 5] }
                                        },
                                        {
                                            extend: 'pdf',
                                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                                            className: 'dropdown-item',
                                            exportOptions: { columns: [1, 2, 3, 4, 5] }
                                        },
                                        {
                                            extend: 'copy',
                                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                                            className: 'dropdown-item',
                                            exportOptions: { columns: [1, 2, 3, 4, 5] }
                                        }
                                    ],
                                    init: function (api, node, config) {
                                        $(node).removeClass('btn-secondary')
                                        $(node).parent().removeClass('btn-group')
                                        setTimeout(function () {
                                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50')
                                        }, 50)
                                    }
                                },
                                {
                                    text: 'Add New User',
                                    className: 'add-new btn btn-primary',
                                    attr: {
                                        'data-bs-toggle': 'modal',
                                        'data-bs-target': '#modals-slide-in'
                                    },
                                    init: function (api, node, config) {
                                        $(node).removeClass('btn-secondary')
                                    }
                                }
                            ]*/
                        })
                        $('.datatable-filter').on('change', function(){
                            elem.DataTable().ajax.reload();
                        });
                    }
                }
            });
        </script>
    @endsection
@else
    <div class="p-3">Data table oluşturulamadı</div>
@endif
