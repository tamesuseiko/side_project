<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    protected $controller = 'product';
    protected $folder = 'product';
    protected $name_page = "";

    public function datatable(Request $request)
    {
        $like = $request->Like;
        $sTable = Product::orderby('id', 'desc');
            // ->when($like, function ($query) use ($like) {
            //     if (@$like['search_choice'] != "") {
            //         if (@$like['search_type'] == "like") {
            //             $query->where(@$like['search_choice'], 'like', '%' . @$like['search_keyword'] . '%');
            //         } else {
            //             $query->where(@$like['search_choice'], @$like['search_type'], @$like['search_keyword']);
            //         }
            //     }
            // });
        return DataTables::of($sTable)
            ->addIndexColumn()
            ->addColumn('price', function ($row) {
                $data =  number_format($row->price);
                return $data;
            })
            ->addColumn('created_at', function ($row) {
                $data = date('d/m/Y', strtotime('+543 Years', strtotime($row->created_at)));
                return $data;
            })
            ->addColumn('details', function ($row) {
                $details = Str::limit($row->details, 80);

                $data =  $details;

                return $data;
            })
            ->addColumn('updated_at', function ($row) {
                $data = date('d/m/Y', strtotime('+543 Years', strtotime($row->updated_at)));
                return $data;
            })
            ->addColumn('action', function ($row) {
                $data = "";

                $data .= " <a href='/$this->folder/edit/$row->id' class='mr-3 btn btn-sm btn-warning' title='แก้ไข'><i class='fa fa-edit w-4 h-3 mr-1'></i> แก้ไข </a>";
                $data .= " <a href='javascript:' class='btn btn-sm btn-danger' onclick='deleteItem($row->id)' title='ลบ'><i class='far fa-trash-alt w-4 h-3 mr-1'></i> ลบ</a>";

                return $data;
            })

            ->rawColumns(['action_name', 'status', 'created_at', 'action'])
            ->make(true);
    }
    public function index(Request $request)
    {
       $product=  Product::orderby('id', 'desc')->where('status','active')->get();
        // dd($product);
        return view("$this->folder.index",[
            'product' => $product,
        ]);
    }
    public function add(Request $request)
    {
        return view("$this->folder.add");

    }
    public function edit(Request $request, $id)
    {
        $data = Product::find($id);

        return view("$this->folder.edit", [
            'data' => $data,
        ]);
    }



    // เพิ่มข้อมูล และ แก้ไขข้อมูล
    public function insert(Request $request, $id = null)
    {
        return $this->store($request, $id = null);
    }
    public function update(Request $request, $id)
    {
        return $this->store($request, $id);
    }
    public function store($request, $id = null)
    {
        $request->validate([
            'type'=>'required',
            'brand'=>'required',
            'name'=>'required|max:150',
            'price'=>'required|max:10',
        ],[
            'type.required' =>'กรุณาเลือกประเภทสินค้า',
            'brand.required' =>'กรุณาเลือกยี่ห้อสินค้า',
            'name.required' =>'กรุณาป้อนชื่อสินค้า',
            'price.required' =>'กรุณาป้อนราคาสินค้า',
        ]
        );

        try {
            DB::beginTransaction();

            // สร้างข้อมูลใหม่
            if ($id == null) {
                $data = new Product();
                $data->type = $request->type;
                $data->brand = $request->brand;
                $data->status ='active';
            } else {
                // แก้ไขข้อมูล
                $data = Product::find($id);
            }

            $data->name = $request->name;
            $data->price = $request->price;
            $data->details = $request->details;

            // เพิ่มรูปภาพ
            $image = $request->file('image');
            if ($image != null) {
                $image_gen1 = '/product_img/product_' . date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/product_img', $image_gen1);
                // ลบไฟล์ภาพ
                if ($data->image != null) {
                    $path_img1 = public_path($data->image);
                    if (file_exists($path_img1) != '') {
                        unlink($path_img1);
                    }
                }
                $data->image = $image_gen1;
            }

            // dd($data);
            if ($data->save()) {
                DB::commit();

                return view("alert.alert", [
                    'url' => url("$this->folder"),
                    'title' => "สำเร็จ",
                    'text' => "ระบบได้ทำการบันทึกข้อมูลเรียบร้อย",
                    'icon' => 'success'
                ]);
            } else {
                return view("alert.alert", [
                    'url' => url("$this->folder.add"),
                    'title' => "เกิดข้อผิดพลาดทางโปรแกรม",
                    'text' => "กรุณาแจ้งรหัส Code : ให้ทางผู้พัฒนาโปรแกรม ",
                    'icon' => 'error'
                ]);
            }
        } catch (\Exception $e) {
    }
    }

    // ลบ
    public function destroy(Request $request)
    {

        $datas = Product::find($request->id);
        if (@$datas->status !=  'inactive') {
            $query = Product::destroy($datas->id);
            if ($datas->image != null) {
                $path_img1 = public_path($datas->image);
                if (file_exists($path_img1) != '') {
                    unlink($path_img1);
                }
            }
        }

        if (@$query) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
