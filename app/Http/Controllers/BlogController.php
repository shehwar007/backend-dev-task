<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Blog};
use DataTables;

class BlogController extends Controller
{
    //
    public function index()
    {
        return view('blog.blog');
    }
    public function insertBlog(Request $request)
    {
        if (blogger_id()) {
            $validatedata = $this->validate($request, Blog::VALIDATION_RULES);
            $validatedata['blogger_id'] = blogger_id();
            $user = Blog::create($validatedata);
            session()->flash("success", "Blog Added Successfully");
            return back();
        } else {
            session()->flash("error", "Some thing Went Wrong");
            return back();
        }
    }
    public function viewBlog()
    {
        if (blogger_id()) {
            $query = Blog::select('blogger_id', 'title', 'content', 'status')->where('status', 'Active')->where('blogger_id', blogger_id())->latest()->get();
        } elseif (super_admin() || admin_user()) {
            $query = Blog::select('blogger_id', 'title', 'content', 'status')->where('status', 'Active')->latest()->get();
        } else {
            $query = [];
        }
        $result = DataTables::of($query)->addColumn('user', function ($row) {
            return  empty($row->blogger_info->name) ? 'Not Set' : $row->blogger_info->name;
        })->addIndexColumn()->make(true);
        return $result;
    }
}
