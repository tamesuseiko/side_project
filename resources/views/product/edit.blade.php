@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">แก้ไขสินค้า</div>

                <div class="card-body  bg-white">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">ประเภทสินค้า</label>
                            <div class="col-md-6">
                                <select class="form-select " id="" name=""  disabled>
                                    <option value="" selected disabled>ประเภทสินค้า</option>
                                    <option value="mouse" {{ 'mouse' == @$data->type ? 'selected' : '' }}>mouse</option>
                                    <option value="keyboard" {{ 'keyboard' == @$data->type ? 'selected' : '' }}>keyboard</option>
                                    <option value="monitor" {{ 'monitor' == @$data->type ? 'selected' : '' }}>monitor</option>
                                </select>
                                <input type="hidden" name="type" value="{{ $data->type }}">
                                @error('type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">ยี่ห้อ</label>
                            <div class="col-md-6">
                                <select class="form-select " id="" name=""  disabled>
                                    <option value=""selected disabled>ยี่ห้อ</option>
                                    <option value="logitech" {{ 'logitech' == @$data->brand ? 'selected' : '' }}>logitech</option>
                                    <option value="hyperx" {{ 'hyperx' == @$data->brand ? 'selected' : '' }}>hyperx</option>
                                    <option value="razer" {{ 'razer' == @$data->brand ? 'selected' : '' }}>razer</option>
                                    <option value="asus" {{ 'asus' == @$data->brand ? 'selected' : '' }}>asus</option>
                                    <option value="samsung" {{ 'samsung' == @$data->brand ? 'selected' : '' }}>samsung</option>
                                </select>
                                <input type="hidden" name="brand" value="{{ $data->brand }}">
                                @error('brand')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-form-label text-md-end">ชื่อสินค้า</label>

                            <div class="col-md-6">
                                <input id="" type="text" class="form-control " name="name" value="{{ $data->name }}" >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">ราคาสินค้า</label>
                            <div class="col-md-6">
                                <input id="" type="number" class="form-control " name="price" value="{{ $data->price }}">
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">รายละเอียดสินค้า</label>

                            <div class="col-md-6">
                                <textarea id="" cols="10" rows="3" name="details" class="form-control">{{ $data->details }}</textarea>
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
                                <img id="preview" src="{{ asset(@$data->image) }}" alt="" width="300px" height="300px" class="mt-3 mb-3 d-flex" />
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


