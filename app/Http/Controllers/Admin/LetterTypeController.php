<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LetterType;
use Illuminate\Http\Request;

class LetterTypeController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Letter Type', private $access = [])
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
                $letterType = LetterType::select(['id', 'type', 'code'])->latest('id')->paginate(10);
                return view('admin.letter_type.index', [
                    'name' => $this->name,
                    'letters' => $letterType,
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
                return view('admin.letter_type.create', [
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
                    'type' => 'required',
                    'code' => 'required',
                    'number' => 'required',
                ]);

                if (!$validated->fails()) {
                    $letterType = new LetterType;
                    $letterType->type = $request->input('type');
                    $letterType->code = $request->input('code');
                    // $letterType->number = $request->input('number');
                    // $letterType->ordinal = '0000';
                    $letterType->save();
                } else {
                    return redirect()->back()->with('failed', $validated->getMessageBag())->withInput();
                }

                return redirect()->to(route('letter_type.index'))->with('success', 'Data Added!');
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
    public function show(LetterType $letterType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterType $letterType)
    {
        try {
            $this->get_access_page();
            if ($this->access['Update'] == 1) {
                return view('admin.letter_type.edit', [
                    'name' => $this->name,
                    'letterType' => $letterType
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
    public function update(Request $request, LetterType $letterType)
    {
        try {
            $this->get_access_page();
            if ($this->access['Update'] == 1) {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'type' => 'required',
                    'code' => 'required',
                    'number' => 'required',
                ]);

                if (!$validated->fails()) {
                    $letterType->type = $request->input('type');
                    $letterType->code = $request->input('code');
                    // $letterType->number = $request->input('number');
                    $letterType->save();
                } else {
                    return redirect()->back()->with('failed', $validated->getMessageBag())->withInput();
                }

                return redirect()->to(route('letter_type.index'))->with('success', 'Data Updated!');
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
    public function destroy(LetterType $letterType)
    {
        try {
            $this->get_access_page();
            if ($this->access['Delete'] == 1) {
                $letterType->delete();

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
