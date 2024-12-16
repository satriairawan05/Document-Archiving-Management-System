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
                $mails = OutgoingMail::where('letter_id',$letter_id)->latest()->get();
                $letters = \App\Models\LetterType::select('id', 'type', 'code')->paginate(12);

                return isset($letter_id) ? view('admin.outoging_mail.index', ['name' => $this->name, 'access' => $this->access, 'mails' => $mails, 'letter_id' => $letter_id]) : view('admin.outoging_mail.list', ['name' => $this->name, 'access' => $this->access, 'letters' => $letters]);
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
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'from' => 'required',
                    'sender' => 'required',
                    'receipint' => 'required',
                    'subject' => 'required',
                    'document' => 'required|file|mimes:pdf|max:5120',
                ]);

                if (!$validated->fails()) {
                    $mail = new OutgoingMail;
                    $mail->date = now();
                    $file = $request->file('document');
                    $mail->subject = $request->input('subject');
                    $mail->from = $request->input('from');
                    $mail->sender = $request->input('sender');
                    $mail->receipint = $request->input('receipint');
                    $mail->document = $file->store('Mail');
                    $mail->doc_name = $file->getClientOriginalName();
                    $mail->doc_extension = $file->getClientOriginalExtension();
                    $mail->letter_id = $request->input('letter_id');
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
    public function show(OutgoingMail $outgoingMail)
    {
        try {
            $this->get_access_page();
            if ($this->access['Read'] == 1) {
                if (!\Illuminate\Support\Facades\Storage::exists($outgoingMail->document)) {
                    abort(404, 'File Not Found!');
                }

                $filePath = \Illuminate\Support\Facades\Storage::path($outgoingMail->document);

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
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'from' => 'required',
                    'sender' => 'required',
                    'receipint' => 'required',
                    'subject' => 'required',
                ]);

                if (!$validated->fails()) {
                    $outgoingMail->date = now();
                    $outgoingMail->subject = $request->input('subject');
                    $outgoingMail->from = $request->input('from');
                    $outgoingMail->sender = $request->input('sender');
                    $outgoingMail->receipint = $request->input('receipint');
                    $file = $request->file('document');
                    if ($request->hasFile('document')) {
                        if ($outgoingMail->document != $file) {
                            \Illuminate\Support\Facades\Storage::delete($outgoingMail->document);
                        }

                        $outgoingMail->document = $file->store('Mail');
                    }
                    $outgoingMail->doc_name = $file->getClientOriginalName();
                    $outgoingMail->doc_extension = $file->getClientOriginalExtension();
                    $outgoingMail->letter_id = $request->input('letter_id');
                    $outgoingMail->user_id = auth()->user()->id;
                    $outgoingMail->save();
                } else {
                    return redirect()->back()->with('failed', $validated->getMessageBag())->withInput();
                }
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
                if ($outgoingMail->document && \Illuminate\Support\Facades\Storage::exists($outgoingMail->document)) {
                    \Illuminate\Support\Facades\Storage::delete($outgoingMail->document);
                }

                $outgoingMail->delete();

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
