<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\File;
use App\User;

class FilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['download']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('files.index')->with('files', $files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|max:49999'
        ]);
        if($request->hasFile('file')){
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_'.time().'.'.$extension;
            $fullPath = 'public/file_uploads/'.auth()->user()->unique_id;
            $path = $request->file('file')->storeAs($fullPath, $fileNameToStore);
        }else{
            $fileNameToStore = '';
        }
        $file = new File;
        $file->title = $request->input('title');
        $file->description = $request->input('description');
        $file->user_id = auth()->user()->id;
        $file->private = $request->input('private');
        $file->unique_id = md5($file->title . ';' . auth()->user()->id . ';' . $file->created_at);
        $file->file = $fileNameToStore;
        $file->save();
        return redirect('/files')->with('success', 'File Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::where('unique_id',$id)->first();
        if($file == null){
            return redirect('files')->with('error', 'File either does not exist or is private');
        }
        return view('files.show')->with('file', $file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::where('unique_id',$id)->first();
        if($file == null){
            return redirect('files')->with('error', 'File either does not exist or is private');
        }
        if(auth()->user()->id != $file->user_id){
            return redirect('files')->with('error', 'Unauthorized page');
        }
        return view('files.edit')->with('file', $file);
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $file = File::where('unique_id',$id)->first();
        if($file == null){
            return redirect('files')->with('error', 'File either does not exist or is private');
        }
        $file->title = $request->input('title');
        $file->description = $request->input('description');
        $file->private = $request->input('private');
        $file->save();
        return redirect('/files')->with('success', 'File Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::where('unique_id',$id)->first();
        if(auth()->user()->id != $file->user_id){
            return redirect('files')->with('error', 'Unauthorized access!');
        }
        if($file == null){
            return response('File not Found!', 404);
        }
        $creator = User::find($file->user_id);
        $path = 'public/file_uploads/'.$creator->unique_id.'/'.$file->file;
        Storage::delete($path);
        $file->delete();
        return redirect('/files')->with('success', 'File deleted');
    }
    /**
     * Send download of file requested
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id){
        $file = File::where('unique_id',$id)->first();
        if($file == null){
            return response('File not Found!', 404);
        }
        $creator = User::find($file->user_id);
        $path = public_path().'/storage/file_uploads/'.$creator->unique_id.'/'.$file->file;
        if($file->private){
            if(auth()->check()){
                if(auth()->user()->id != $file->user_id){
                    return redirect('files')->with('error', 'File either does not exist or is private');
                }
            }else{
                return redirect('/')->with('error', 'File either does not exist or is private');
            }
        }
        return response()->download($path);
    }
}
