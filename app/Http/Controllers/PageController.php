<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
class PageController extends Controller
{
    
// Method to display page by slug
public function show($slug)
{
    $page = Page::where('slug', $slug)->firstOrFail();  // Retrieve page by slug

    return view('page', compact('page'));  // Return view with the page data
}
public function index(Request $request)
{
    // Start a query to get all pages from the pages table
    $query = DB::table('pages'); 

    // Filter by title (only if the title is not empty)
    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    // Filter by show_tips (only if show_tips is not empty)
    if ($request->filled('show_tips')) {
        $query->where('show_tips', $request->show_tips);
    }

    // Filter by show_nav (only if show_nav is not empty)
    if ($request->filled('show_nav')) {
        $query->where('show_nav', $request->show_nav);
    }

    // Filter by status (only if status is not empty)
    if ($request->filled('status')) {
        $query->where('published', $request->status);
    }

    // Get the number of results per page from the 'per_page' input, default to 10 if not provided
    $perPage = $request->get('per_page', 10); // Default to 10 if not specified

    // Paginate the result
    $pages = $query->paginate($perPage);

    // Append all the current query parameters to the pagination links
    $pages->appends($request->all());

    return view('admin.pages', compact('pages'));
}

    
    

    public function create()
    {
        return view('admin.pages_create'); // Show the page creation form
    }

    public function edit(Page $page)
    {
        return view('admin.pages_edit', compact('page')); // Show the page editing form
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255', // Added name validation
        'title' => 'required|string|max:255',
        'slug' => 'required|unique:pages,slug',
        'text' => 'required',
        'published' => 'required',
        'show_nav' => 'required|boolean', // Added show_nav validation
        'show_tips' => 'required|boolean', // Added show_tips validation
    ]);

    // Store the page
    Page::create($validated);

    return redirect()->route('admin.pages')->with('success', 'Page created successfully');
}

public function update(Request $request, Page $page)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255', // Added name validation
        'title' => 'required|string|max:255',
        'slug' => 'required|unique:pages,slug,' . $page->id,
        'text' => 'required',
        'published' => 'required',
        'show_nav' => 'required|boolean', // Added show_nav validation
        'show_tips' => 'required|boolean', // Added show_tips validation
    ]);

    // Update the page
    $page->update($validated);

    return redirect()->route('admin.pages')->with('success', 'Page updated successfully');
}


    public function destroy(Page $page)
    {
        $page->delete(); // Delete the page

        return redirect()->route('admin.pages')->with('success', 'Page deleted successfully');
    }
}
