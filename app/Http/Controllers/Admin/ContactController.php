<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\Http\Request;

/**
 * Class ContactController
 * @package App\Http\Controllers
 */
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:contacts-list',  ['only' => ['index']]);
        $this->middleware('permission:contacts-view',  ['only' => ['show']]);
        $this->middleware('permission:contacts-create',['only' => ['create','store']]);
        $this->middleware('permission:contacts-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:contacts-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::get();

        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contact = new Contact();
        return view('admin.contact.create', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $contact = Contact::create($request->all());
        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);

        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);

        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $contact = Contact::find($id)->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully');
    }
}
