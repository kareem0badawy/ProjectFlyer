<?php

namespace App\Http\Controllers;

use App\Flyer;

use App\Photo;

use Auth;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\File\UploadedFile;


use App\Http\Requests\FlyerRequest;

use App\Http\Controllers\Controller;



class FlyerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //flash('Hello World...!' , 'The is the meesage.');
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FlyerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
       // $this->validate();

        Flyer::create($request->all());
        

        flash( 'Success ✔ ✔','Your flyer has been created');
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip,$street)
    {
        $flyer = Flyer::locatedAt($zip,$street);

        return view('flyers.show', compact('flyer'));
    }

     /**
     *  Apply a photo to the referenced flyer .
     *   
     * @param   string   $zip      
     * @param   string   $street   
     * @param   Request  $request            
     */
 
    public function addPhoto($zip,$street,Request $request)
    {
        
     $this->validate($request,[
        'photo' => 'required|mimes:jpg,jpeg,png,bmp'
         ]);
        
        $flyer =  Flyer::locatedAt($zip,$street);
       
        if(! ) {
            return $this->unauthorized($request);
        }

        $photo = $this->makePhoto($request->file('photo'));
        
        $flyer->addPhoto($photo);
        
        return 'Done';
    }

    protected function unauthorized(Request $request)
    {
        if ($request->ajax()) {
                return response(['message' => 'No way .'], 403);
            }

            flash('No way.');

            return redirect('/');
    }

    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())
        ->move($file);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
