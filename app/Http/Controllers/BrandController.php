<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
       {
           if ($request->ajax()) {
               $data=Brand::latest()->get();
               return DataTables::of($data)
                       ->addIndexColumn()
                       ->addColumn('action', function($row){
                           $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                           <a href="'.route('brand.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_category"><i class="fas fa-trash"></i>
                           </a>';
                          return $actionbtn;   
                       })
                       ->rawColumns(['action'])
                       ->make(true);       
           }
           return view('admin.brand.index');
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
          {
            // dd($request->all());
            // die();
            
    	$validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
         ]);

        
         $data=array();
         $data['brand_name']=$request->brand_name;
         $data['brand_slug']=Str::slug($request->brand_name, '-');
         $data['front_page']=$request->front_page;
          //working with image
        //   if($request->hasFile('brand_logo')){
        //     $photo=$request->brand_logo;
        //     $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
           
        //     // $photo->move('public/files/brand/',$photoname);  //without image intervention
        //     Image::make($photo)->resize(240,120)->save('files/brand/'.$photoname);  //image intervention
  
        //   $data['brand_logo']=$new_name_image;   // public/files/brand/plus-point.jpg
         

        //   }
        //   else{
        //     echo "not work";
        //   }

        if($request->hasFile('brand_logo')){
            dd($request->brand_logo);
            $new_name_image = now()->format('Y-m-d').".".$request->file('brand_logo')->getClientOriginalExtension();
            $img = Image::make($request->file('brand_logo'))->resize(1264, 948);
            $img->save(base_path('public/files/brand'. $new_name_image), 80);
            $data['brand_logo']=$new_name_image;
         }
           DB::table('brands')->insert($data);
         $notification=array('messege' => 'Brand Inserted!', 'alert-type' => 'success');
         return redirect()->back()->with($notification);
          }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
