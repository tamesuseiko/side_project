@extends('layouts.app')

@section('content')
@include('layouts.css')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">เบิกสินค้า</div>

                <div class="card-body bg-white">
                    <form method="POST" action="{{ url('request_product/insert') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Mouse</label>
                            <div class="col-md-6">
                                <select class="form-select select2" id="" name="id_mouse">
                                    <option value="" selected disabled>Mouse</option>
                                    @foreach ($mouse as $item)
                                    <option value="{{ $item->id }}">[{{ $item->brand }}]  {{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Keyboard</label>
                            <div class="col-md-6">
                                <select class="form-select select2" id="" name="id_keyboard">
                                    <option value="" selected disabled>Keyboard</option>
                                    @foreach ($keyboard as $item)
                                    <option value="{{ $item->id }}">[{{ $item->brand }}]  {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Monitor</label>
                            <div class="col-md-6">
                                <select class="form-select select2" id="" name="id_monitor[]">
                                    <option value="" selected disabled>Monitor</option>
                                    @foreach ($monitor as $item)
                                    <option value="{{ $item->id }}">[{{ $item->brand }}]  {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary add" id="add" ><i class="fas fa-plus"></i>
                                    เพิ่ม
                                </button>
                            </div>
                        </div>

                        <span id="monitor_select"></span>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">หมายเหตุ</label>
                            <div class="col-md-6">
                                <textarea id="" cols="10" rows="3" name="details" class="form-control"></textarea>
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   บันทึก
                                </button>

                                <a href="{{ url('request_product') }}" class="btn btn-warning">ยกเลิก</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.script')

<script>
    // เพิ่ม Select Monitor
    var number = 1; ;
  $(document).on('click', '.add', function() {

            dynamic_field(number);
    function dynamic_field(number) {
            html =
            `
                <div class="row mb-4" id="monitor${number}">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Monitor</label>
                    <div class="col-md-6">
                        <select class="form-select select2_html" id="" name="id_monitor[]">
                            <option value="" selected disabled>Monitor</option>
                            @foreach ($monitor as $item)
                            <option value="{{ $item->id }}">[{{ $item->brand }}]  {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button"  onclick="removeTable(${number})" class="btn btn-danger">
                            ลบ
                        </button>
                    </div>
                </div>




            `
            $('#monitor_select').append(html);
        }
        number++;
        $(".select2_html").select2({
            width: '100%'
        });
   });

    //    ลบ Select Monitor
   function removeTable(id) {
        $(`#monitor${id}`).remove();
    }

</script>

<script>

   // ค้นหา Select
   $(".select2").select2({
        width: '100%'
    });
</script>
@endsection


