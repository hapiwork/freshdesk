<?php

namespace Hapiwork\Freshdesk\Http\Controllers\Api;

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
    public function index(Request $request)
    {
        return Template::with('user')->where('user_id', $request->input('user_id'))->orWhere->global()->orderBy('title', 'asc')->get();
    }
    
}
