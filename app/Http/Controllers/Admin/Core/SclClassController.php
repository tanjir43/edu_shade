<?php

namespace App\Http\Controllers\Admin\Core;

use App\DataTables\SclClassDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\School;
use App\Models\Version;
use App\Models\Shift;
use App\Repositories\Interfaces\SclClassRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SclClassController extends Controller
{
    protected $sclClassRepository;

    public function __construct(SclClassRepositoryInterface $sclClassRepository)
    {
        $this->sclClassRepository = $sclClassRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SclClassDataTable $dataTable, Request $request)
    {
        if ($request->ajax()) {
            return $dataTable->render('admin.sclClass.index');
        }

        return $dataTable->render('admin.sclClass.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::where('active_status', 1)->pluck('name', 'id');
        $branches = Branch::where('active_status', 1)->pluck('name', 'id');
        $versions = Version::where('active_status', 1)->pluck('name', 'id');
        $shifts = Shift::where('active_status', 1)->pluck('name', 'id');

        return view('admin.sclClass.create', compact('schools', 'branches', 'versions', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'class_code' => 'nullable|string|max:50',
            'class_level' => 'nullable|numeric',
            'school_id' => 'required|exists:schools,id',
            'branch_id' => 'nullable|exists:branches,id',
            'version_id' => 'nullable|exists:versions,id',
            'shift_id' => 'nullable|exists:shifts,id',
            'active_status' => 'required|in:0,1',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            $data['created_by'] = Auth::id();

            $sclClass = $this->sclClassRepository->create($data);

            DB::commit();

            return redirect()->route('admin.sclClasses.index')
                ->with('success', 'Class created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error occurred while creating class: ' . $e->getMessage());
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
        $sclClass = $this->sclClassRepository->find($id);

        return view('admin.sclClass.show', compact('sclClass'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sclClass = $this->sclClassRepository->find($id);
        $schools = School::where('active_status', 1)->pluck('name', 'id');
        $branches = Branch::where('active_status', 1)->pluck('name', 'id');
        $versions = Version::where('active_status', 1)->pluck('name', 'id');
        $shifts = Shift::where('active_status', 1)->pluck('name', 'id');

        return view('admin.sclClass.edit', compact('sclClass', 'schools', 'branches', 'versions', 'shifts'));
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
        $request->validate([
            'name' => 'required|string|max:200',
            'class_code' => 'nullable|string|max:50',
            'class_level' => 'nullable|numeric',
            'school_id' => 'required|exists:schools,id',
            'branch_id' => 'nullable|exists:branches,id',
            'version_id' => 'nullable|exists:versions,id',
            'shift_id' => 'nullable|exists:shifts,id',
            'active_status' => 'required|in:0,1',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            $data['updated_by'] = Auth::id();

            $this->sclClassRepository->update($id, $data);

            DB::commit();

            return redirect()->route('admin.sclClasses.index')
                ->with('success', 'Class updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error occurred while updating class: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Set deleted_by before deleting
            $sclClass = $this->sclClassRepository->find($id);
            $sclClass->update(['deleted_by' => Auth::id()]);

            $this->sclClassRepository->delete($id);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Class deleted successfully.']);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => 'Error occurred while deleting class: ' . $e->getMessage()]);
        }
    }

    /**
     * Restore a soft-deleted resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {
            $this->sclClassRepository->restore($id);

            return redirect()->route('admin.sclClasses.index')
                ->with('success', 'Class restored successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error occurred while restoring class: ' . $e->getMessage());
        }
    }

    /**
     * Filter classes based on criteria using the repository.
     * This method will remain for API use but mainly DataTables will handle filtering
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        if ($request->ajax()) {
            return redirect()->route('admin.sclClasses.index', $request->all());
        }

        return redirect()->route('admin.sclClasses.index', $request->all());
    }
}
