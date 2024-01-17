@extends('layouts.app')

@section('content')
@include('layouts.css')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 ">
            <a href="{{ url('request_product/add') }}" class="btn btn-success">เบิกสินค้า</a>
            <div class="card p-4 mt-2 ">
                <div class=" scrollbar-hidden mt-3 ">
                    <table id="data-table" class="table nowrap " style=" width: 100%;"></table>

                </div>
            </div>
        </div>
    </div>


  <!-- Modal -->
  <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>

@include('layouts.script')
<script>

    // datatable
    var fullUrl = window.location.origin + window.location.pathname;
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
                        left: 3,
                        right: 1
                    },

                ajax: {
                    url: fullUrl + "/datatable",
                    method: 'POST'
                },

                columns: [{
                        data: 'id',
                        title: '<center>ลำดับ</center>',
                        width: '5%',

                    }, // 0
                    {
                        data: 'id_user',
                        title: '<center>พนักงาน</center>',
                        width: '20%',

                    }, // 1
                    {
                        data: 'details',
                        title: '<center>หมายเหตุ</center>',
                        width: '30%',

                    }, // 1
                    {
                        data: 'created_at',
                        title: '<center>วันที่ขอ</center>',
                        width: '5%',

                    }, // 3
                    {
                        data: 'action',
                        title: '<center>จัดการ</center>',
                        width: '5%',

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

    // แสดง Modal
    function show_modal(id) {

        $.ajax({
            type: 'GET',
            url: fullUrl + '/' + id + '/show_modal',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
            },
            dataType: 'html',
            success: function(data) {
                $('#exampleModal').modal('show');
                $('.modal-content').html(data);
                // $('#show_modal').modal('show');
            }
        });
    }


// ส่ง Mail
function sendmail(id) {
    Swal.fire({
    title: "ต้องการส่งอีเมล ?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ใช่, ต้องการ!",
    cancelButtonText: "ยกเลิก"
    }).then((result) => {
if (result.isConfirmed) {
    $.ajax({
            type: 'GET',
            url: fullUrl + '/sendmail/'  + id ,
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
            },
            dataType: 'html',
            success: function(data) {
                $('#exampleModal').modal('show');
                $('.modal-content').html(data);
                // $('#show_modal').modal('show');
            }
        });

}
});
    }

</script>
@endsection


