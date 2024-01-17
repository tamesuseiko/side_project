<?php

namespace App\Http\Controllers;

use App\Mail\ReportMail;
use App\Models\Product;
use App\Models\RequestProduct;
use App\Models\RequestProductMonitor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class RequestProductController extends Controller
{
    protected $controller = 'request_product';
    protected $folder = 'requestproduct';
    protected $name_page = "";

    public function datatable(Request $request)
    {

        $like = $request->Like;
        if( Auth::user()->role_user =='admin' ){
            $sTable = RequestProduct::orderby('id', 'desc')->get();
        }else{
            $sTable = RequestProduct::orderby('id', 'desc')->where('id_user',Auth::user()->id);
        }
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

            ->addColumn('id_user', function ($row) {
                $User = User::find($row->id_user);
                $data = $User->first_name .' '. $User->last_name;
                return $data;
            })
            ->addColumn('created_at', function ($row) {
                $data = date('d/m/Y', strtotime('+543 Years', strtotime($row->created_at)));
                return $data;
            })
            ->addColumn('updated_at', function ($row) {
                $data = date('d/m/Y', strtotime('+543 Years', strtotime($row->updated_at)));
                return $data;
            })
            ->addColumn('action', function ($row) {
                $data = "";
                $data .= "
                <a href='javascript:;' data-tw-toggle='modal' data-tw-target='#show_modal' onclick='show_modal($row->id);'
                    class='btn btn-primary shadow-md mr-2  btn-sm'>ดูรายละเอียด</a>
                ";

                return $data;
                return $data;
            })

            ->rawColumns(['action_name', 'status', 'created_at', 'action'])
            ->make(true);
    }

    public function index(Request $request)
    {
       $requestproduct=  RequestProduct::orderby('id', 'desc')->where('status','active')->get();
        return view("$this->folder.index",[
            'requestproduct' => $requestproduct,
        ]);
    }
    public function add(Request $request)
    {
        $mouse=  Product::orderby('id', 'desc')->where('status','active')->where('type','mouse')->get();
        $keyboard=  Product::orderby('id', 'desc')->where('status','active')->where('type','keyboard')->get();
        $monitor=  Product::orderby('id', 'desc')->where('status','active')->where('type','monitor')->get();
        return view("$this->folder.add",[
            'mouse' => $mouse,
            'keyboard' => $keyboard,
            'monitor' => $monitor,
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

         try {
             DB::beginTransaction();
                 $data = new RequestProduct();
                 $data->id_mouse = $request->id_mouse;
                 $data->id_keyboard = $request->id_keyboard;
                 $data->id_user = Auth::user()->id;
                 $data->details = $request->details;
                 $data->status = 'active';
            // dd($data);

             if ($data->save()) {
                 DB::commit();

                 $RequestProduct = RequestProduct::all()->last();

                //  ลูปเพิ่มข้อมูล Monitor
                if($request->id_monitor){
                    $id_monitor = $request->id_monitor;
                    for ($count = 0; $count < count($id_monitor); $count++) {
                        $RequestProductMonitor = new RequestProductMonitor();
                        $RequestProductMonitor->id_reques_product = $RequestProduct->id;
                        $RequestProductMonitor->id_monitor = $id_monitor[$count];
                        $RequestProductMonitor->save();
                    }
                }


                 return view("alert.alert", [
                     'url' => url("$this->controller"),
                     'title' => "สำเร็จ",
                     'text' => "ระบบได้ทำการบันทึกข้อมูลเรียบร้อย",
                     'icon' => 'success'
                 ]);
             } else {
                 return view("alert.alert", [
                     'url' => url("$this->controller.add"),
                     'title' => "เกิดข้อผิดพลาดทางโปรแกรม",
                     'text' => "กรุณาแจ้งรหัส Code : ให้ทางผู้พัฒนาโปรแกรม ",
                     'icon' => 'error'
                 ]);
             }
         } catch (\Exception $e) {
     }
     }

     public function show_modal(Request $request)
     {
       $RequestProduct =  RequestProduct::join('users','users.id','request_products.id_user')->find($request->id);
       $mouse = Product::where('id',$RequestProduct->id_mouse)->first();
       $keyboard = Product::where('id',$RequestProduct->id_keyboard)->first();
       $RequestProductMonitor = RequestProductMonitor::join('products','products.id','request_product_monitors.id_monitor')->where('id_reques_product',$request->id)->get();
       return view("$this->folder.show_modal", [
                'RequestProduct' => $RequestProduct,
                'RequestProductMonitor' => $RequestProductMonitor,
                'mouse' => $mouse,
                'keyboard' => $keyboard,
         ]);
     }

     public function sendmail(Request $request){
        dd('asd');
        $id =  $request->id;
        Mail::to('thitipat1020@gmail.com')->send(new ReportMail($id));


     }
}
