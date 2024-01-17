@extends('layouts.app')

@section('content')
@include('layouts.css')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">เพิ่มสินค้า</div>

                <div class="card-body bg-white">
                    <form method="POST" action="{{ url('product/insert') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">ประเภทสินค้า</label>
                            <div class="col-md-6">
                                <select class="form-select " id="" name="type">
                                    <option value="" selected disabled>ประเภทสินค้า</option>
                                    <option value="mouse">mouse</option>
                                    <option value="keyboard">keyboard</option>
                                    <option value="monitor">monitor</option>
                                </select>
                                @error('type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">ยี่ห้อ</label>
                            <div class="col-md-6">
                                <select class="form-select " id="" name="brand">
                                    <option value=""selected disabled>ยี่ห้อ</option>
                                    <option value="logitech">logitech</option>
                                    <option value="hyperx">hyperx</option>
                                    <option value="razer">razer</option>
                                    <option value="asus">asus</option>
                                    <option value="samsung">samsung</option>
                                </select>
                                @error('brand')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-form-label text-md-end">ชื่อสินค้า</label>

                            <div class="col-md-6">
                                <input id="" type="text" class="form-control " name="name" >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">ราคาสินค้า</label>

                            <div class="col-md-6">
                                <input id="" type="number" class="form-control " name="price" >
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">รายละเอียดสินค้า</label>
                            <div class="col-md-6">
                                <textarea id="" cols="10" rows="3" name="details" class="form-control"></textarea>
                                {{-- <input id="" type="text" class="form-control " name="details" > --}}
                                @error('details')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-4 col-form-label text-md-end">รูปภาพโลโก้</label>
                            <div class="col-md-6">
                                <input accept="image/*" type='file' name="image" id="image" class="form-control" />
                                <img id="preview" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1200px-Picture_icon_BLACK.svg.png" alt="" width="300px" height="300px" class="mt-3 mb-3 d-flex" />
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   บันทึก
                                </button>

                                <a href="{{ url('product') }}" class="btn btn-warning">ยกเลิก</a>
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
    // preview image
    image.onchange = evt => {
  const [file] = image.files
  if (file) {
    preview.src = URL.createObjectURL(file)
  }
}
</script>

@endsection


