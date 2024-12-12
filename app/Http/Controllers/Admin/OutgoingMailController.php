<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OutgoingMail;
use Illuminate\Http\Request;

class OutgoingMailController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Outgoing Mail', private $access = [])
    {
        //
    }

    /**
     * Generate Access for Controller.
     */
    public function get_access_page()
    {
        $this->access = $this->get_access($this->name, auth()->user()->role_id);

        return $this->access;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->get_access_page();
            if ($this->access['Read'] == 1) {
                $letter_id = request()->input('letter_id');

                return isset($letter_id) ? view('admin.outoging_mail.index', ['name' => $this->name, 'access' => $this->access, 'mails' => OutgoingMail::where('letter_id',$letter_id)->latest('id')->paginate(10)]) : view('admin.outoging_mail.list', ['name' => $this->name, 'access' => $this->access, 'letters' => \App\Models\LetterType::select('id', 'type', 'code')->get()]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->get_access_page();
            if ($this->access['Create'] == 1) {
                return view('admin.outoging_mail.create',[
                    'name' => $this->name,
                    'letters' => \App\Models\LetterType::get()
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->get_access_page();
            if ($this->access['Create'] == 1) {
                //
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OutgoingMail $outgoingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Read'] == 1) {
                //
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OutgoingMail $outgoingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Update'] == 1) {
                return view('admin.outoging_mail.edit',[
                    'name' => $this->name,
                    'letters' => \App\Models\LetterType::all(),
                    'mail' => $outgoingMail
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OutgoingMail $outgoingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Update'] == 1) {
                //
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OutgoingMail $outgoingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Delete'] == 1) {
                //
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
