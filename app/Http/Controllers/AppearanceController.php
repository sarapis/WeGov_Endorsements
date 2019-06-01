<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Logic\User\UserRepository;
use App\Models\Layout;
use Validator;
use Input;
use Response;
use Session;
use Image;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class AppearanceController extends Controller
{
    /**
     * Post Repository
     *
     * @var Post
    //  */
    // protected $about;

    // public function __construct(About $about)
    // {
    //     $this->about = $about;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $layout = Layout::all();
        $user                   = \Auth::user();
        $users              = \DB::table('users')->get();
        $total_users        = \DB::table('users')->count();
        $userRole           = $user->hasRole('user');
        $editorRole         = $user->hasRole('editor');
        $adminRole          = $user->hasRole('administrator');

        $userRole               = $user->hasRole('user');
        $editorRole             = $user->hasRole('editor');
        $adminRole              = $user->hasRole('administrator');

        if($userRole)
        {
            $access = 'User';
        } elseif ($editorRole) {
            $access = 'Editor';
        } elseif ($adminRole) {
            $access = 'Administrator';
        }

             return view('admin.pages.appearance', [
            'users'             => $users,
            'total_users'       => $total_users,
            'user'              => $user,
            'access'            => $access,
            'success' => '', 
            'errors' => '', 
            'message' => '',], compact('layout'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {   
        $logo = Layout::find(3);
        if($request->hasFile('site_logo')){
            
            $companylogo = $request->file('site_logo');
            $filename = time() . '.' . $companylogo->getClientOriginalExtension();
            Image::make($companylogo)->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();})->save( public_path('upload/images/' . $filename ) );
            $logo->link=$filename;
            
        }

        if ($request->input('logo_active') == 'checked')
        {
            $logo->action = 1;
        }
        else {
            $logo->action = 0;
        }
        $logo->save();

        $name = Layout::find(1);
        $name->link=$request->site_name;
        if ($request->input('name_active') == 'checked')
        {
            $name->action = 1;
        }
        else {
            $name->action = 0;
        }
        $name->save();

        $tagline = Layout::find(2);
        $tagline->link=$request->site_tagline;
        if ($request->input('tagline_active') == 'checked')
        {
            $tagline->action = 1;
        }
        else {
            $tagline->action = 0;
        }
        $tagline->save();

        $footer_text=Layout::find(4);
        $footer_text->link=$request->footer_text;
        $footer_text->save();

        $footer_button=Layout::find(5);
        $footer_button->link=$request->footer_button;
        $footer_button->save();

        $footer_link=Layout::find(6);
        $footer_link->link=$request->footer_link;
        $footer_link->save();

        Session::flash('message', 'Appearance updated!');
        Session::flash('status', 'success');

        return redirect('appearance');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->post->find($id);

        if (is_null($post))
        {
            return Redirect::route('posts.index');
        }

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
    	$id = 1;
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, About::$rules);

        if ($validation->passes())
        {
            $about = About::find($id);
            $about->update($input);

            return Response::json(array('success' => true, 'errors' => '', 'message' => 'Post updated successfully.'));
        }

        return Response::json(array('success' => false, 'errors' => $validation, 'message' => 'All fields are required.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->post->find($id)->delete();

        return Redirect::route('admin.posts.index');
    }

    public function upload()
    {
        $file = Input::file('file');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails()) {
            return Response::json(array('success' => false, 'errors' => $validator->getMessageBag()->toArray()));
        }

        $fileName = time() . '-' . $file->getClientOriginalName();
        $destination = public_path() . '/uploads/';
        $file->move($destination, $fileName);

        echo url('/uploads/'. $fileName);
    }
}
