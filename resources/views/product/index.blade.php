@extends('layouts.app')

@section('content')

    @include('layouts.css')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ url('product/add') }}" class="btn btn-success ">เพิ่ม</a>

             <div class="card p-4 mt-2 ">
                <div class=" scrollbar-hidden mt-3">
                    <table id="data-table" class="table nowrap " style=" width: 100%;"></table>

                </div>
            </div>
        </div>

    </div>
</div>

@include('layouts.script')

    <script>

        var fullUrl = window.location.origin + window.location.pathname;
        // datatable
        $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                oTable = $('#data-table').DataTable({
                    // "sDom": "<'row'<'col-sm-12' tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    scroller: true,
                    scrollCollapse: true,
                    scrollX: true,
                    ordering: true,
                    bInfo: true,
                    fixedHeader: true,
                    scrollY: 600,
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        left: 1,
                        right: 1
                    },
                    fixedHeader: {
                        header: true,
                        footer: true
                    },
                    ajax: {
                        url: fullUrl + "/datatable",
                        method: 'POST'
                    },

                    columns: [{
                            data: 'id',
                            title: '<center>ลำดับ</center>',
                        }, // 0
                        {
                            data: 'type',
                            title: '<center>ประเภทสินค้า</center>',

                        }, // 1
                        {
                            data: 'name',
                            title: '<center>ชื่อสินค้า</center>',

                        }, // 1
                        {
                            data: 'price',
                            title: '<center>ราคา</center>',

                        }, // 1
                        {
                            data: 'details',
                            title: '<center>รายละเอียดสินค้า</center>',

                        }, // 3
                        {
                            data: 'action',
                            title: '<center>จัดกาาร</center>',
                        }, // 4

                    ],
                    rowCallback: function(nRow, aData, iDisplayIndex) {
                        $("td:first", nRow).html(aData.DT_RowIndex);
                        return nRow;
                    }
                });
            });
</script>

<script>

    var fullUrl = window.location.origin + window.location.pathname;

    function deleteItem(id) {
        Swal.fire({
        title: "คุณต้องการลบ ?",
        text: "ไม่สามารถกู้คืนได้",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ใช่, ต้องการลบ!",
        cancelButtonText: "ยกเลิก"
        }).then((result) => {
    if (result.isConfirmed) {

        $.ajax({
            type: "post",
            url: fullUrl + "/destroy",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(data) {
                if(data == true){
                    Swal.fire({
                    title: "สำเร็จ",
                    text: "ส่งอีเมลเรียบร้อย",
                    }).then((result) =>{
                        location.reload();
                    });
                }
            }
        });

    }
    });
        }


</script>

@endsection


