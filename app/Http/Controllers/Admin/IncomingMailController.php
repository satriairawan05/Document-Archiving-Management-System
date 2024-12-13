<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomingMail;
use Illuminate\Http\Request;

class IncomingMailController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Incoming Mail', private $access = [])
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
                $mails = IncomingMail::latest('id')->paginate(10);
                return view('admin.incoming_mail.index', [
                    'name' => $this->name,
                    'mails' => $mails,
                    'access' => $this->access
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->get_access_page();
            if ($this->access['Create'] == 1) {
                return view('admin.incoming_mail.create', [
                    'name' => $this->name
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
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'from' => 'required',
                    'sender' => 'required',
                    'receipint' => 'required',
                    'subject' => 'required',
                    'document' => 'required|file|mimes:pdf|max:5120',
                ]);

                if (!$validated->fails()) {
                    $mail = new IncomingMail;
                    $mail->date = now();
                    $mail->subject = $request->input('subject');
                    $mail->from = $request->input('from');
                    $mail->sender = $request->input('sender');
                    $mail->receipint = $request->input('receipint');
                    $mail->document = $request->file('document')->store('Mail');
                    $mail->user_id = auth()->user()->id;
                    $mail->save();
                } else {
                    return redirect()->back()->with('failed', $validated->getMessageBag())->withInput();
                }

                return redirect()->to(route('incoming_mail.index'))->with('success', 'Data Added!');
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
    public function show(IncomingMail $incomingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Read'] == 1) {
                if (!\Illuminate\Support\Facades\Storage::exists($incomingMail->document)) {
                    abort(404, 'File Not Found!');
                }

                $filePath = \Illuminate\Support\Facades\Storage::path($incomingMail->document);

                return response()->file($filePath, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
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
     * Show the form for editing the specified resource.
     */
    public function edit(IncomingMail $incomingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Update'] == 1) {
                return view('admin.incoming_mail.edit', [
                    'name' => $this->name,
                    'mail' => $incomingMail
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
    public function update(Request $request, IncomingMail $incomingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Update'] == 1) {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'from' => 'required',
                    'sender' => 'required',
                    'receipint' => 'required',
                    'subject' => 'required',
                ]);

                if (!$validated->fails()) {
                    $incomingMail->date = now();
                    $incomingMail->subject = $request->input('subject');
                    $incomingMail->from = $request->input('from');
                    $incomingMail->sender = $request->input('sender');
                    $incomingMail->receipint = $request->input('receipint');
                    if ($request->hasFile('document')) {
                        if ($request->file('document') == $incomingMail->document && \Illuminate\Support\Facades\Storage::exists($incomingMail->document)) {
                            \Illuminate\Support\Facades\Storage::delete($incomingMail->document);
                        }

                        $incomingMail->document = $request->file('document')->store('Mail');
                    }
                    $incomingMail->user_id = auth()->user()->id;
                    $incomingMail->save();
                } else {
                    return redirect()->back()->with('failed', $validated->getMessageBag())->withInput();
                }


                return redirect()->to(route('incoming_mail.index'))->with('success', 'Data Updated!');
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
    public function destroy(IncomingMail $incomingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Delete'] == 1) {
                if ($incomingMail->document && \Illuminate\Support\Facades\Storage::exists($incomingMail->document)) {
                    \Illuminate\Support\Facades\Storage::delete($incomingMail->document);
                }

                $incomingMail->delete();

                return redirect()->back()->with('success', 'Data Deleted!');
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
