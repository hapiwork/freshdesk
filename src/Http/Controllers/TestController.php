<?php namespace Hapiwork\Freshdesk\Http\Controllers;

use Illuminate\Routing\Controller;

class TestController extends Controller {
    public function index() {
        return 'In controller';
    }
}