<?php

namespace Hapiwork\Freshdesk\Http\Controllers;

use Illuminate\Http\Request;
use Hapiwork\Freshdesk\Http\Controllers\Controller;
use Hapiwork\Freshdesk\Models\Template;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::with('user')->where('user_id', Auth::id())->orWhere->global()->orderBy('title', 'asc')->get();
        return view("hapiwork-freshdesk::template.index")
                    ->with('templates', $templates);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view("hapiwork-freshdesk::template.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = new Template;
        $template->title = $request->input('title');
        $template->content = $request->input('content');
        $template->user_id = $request->input('user_id');
        $template->is_global =  $request->input('is_global');
        $template->save();
        
        if($template) {
            return redirect()->to('freshdesk/template/'.$template->id.'/edit')
                                ->with("message", "Tạo mẫu tin thành công");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);
    

        return view("hapiwork-freshdesk::template.show")
                        ->with('template', $template);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::find($id);
    

        return view("hapiwork-freshdesk::template.edit")
                        ->with('template', $template);
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
        $template = Template::findOrFail($id);
        $template->title = $request->input('title');
        $template->content = $request->input('content');
        $template->user_id = $request->input('user_id');
        $template->is_global =  $request->input('is_global');
        $template->save();

        return redirect()->to('freshdesk/template/'.$template->id.'/edit')
                        ->with("message", "Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::findOrFail($id);
        if($template->user_id === auth()->id()) {
            $template->delete();
            return redirect()->to('freshdesk/template')->with('message', 'Bạn đã xóa thành công');
        }

        return redirect()->to('freshdesk/template')->with('error', 'Bạn không thể xóa dữ liệu này');
    }
}
