<?php

namespace App\Http\Controllers\Admin\Core;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\DataTables\SclClassDataTable;
use App\Http\Requests\Core\SclClassRequest;
use App\Repositories\Interfaces\SclClassRepositoryInterface;

class SclClassController extends Controller
{
    protected $school;
    protected $sclClassRepository;

    public function __construct(SclClassRepositoryInterface $sclClassRepository)
    {
        $this->school = app('school');
        $this->sclClassRepository = $sclClassRepository;
    }

    public function index(SclClassDataTable $dataTable, Request $request)
    {
        if ($request->ajax()) {
            return $dataTable->render('admin.sclClass.index');
        }

        return $dataTable->render('admin.sclClass.index');
    }

    public function store(SclClassRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            $data = array_merge($data, $this->school->saveCoreSettings());

            $data['created_by'] = Auth::id();

            $this->sclClassRepository->create($data);

            DB::commit();

            return handleResponse('Class created successfully.');

        } catch (Exception $e) {
            DB::rollBack();

            return handleResponse('Error occurred while creating class: ' . $e->getMessage(), 'error');
        }
    }

    public function show($id)
    {
        $sclClass = $this->sclClassRepository->find($id);

        return view('admin.sclClass.show', compact('sclClass'));
    }

    public function edit($id, SclClassDataTable $dataTable, Request $request)
    {
        $sclClass = $this->sclClassRepository->find($id);

        return $dataTable->render('admin.sclClass.index', compact('sclClass'));
    }

    public function update(SclClassRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            $data = array_merge($data, $this->school->saveCoreSettings());

            $data['updated_by'] = Auth::id();

            $this->sclClassRepository->update($id, $data);

            DB::commit();
            return handleResponse('Class updated successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return handleResponse('Error occurred while updating class: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $sclClass = $this->sclClassRepository->find($id);
            $sclClass->update(['deleted_by' => Auth::id()]);

            $this->sclClassRepository->delete($id);

            DB::commit();

            return handleResponse('Class deleted successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return handleResponse('Error occurred while deleting class: ' . $e->getMessage(), 'error');
        }
    }

    public function restore($id)
    {
        try {
            $this->sclClassRepository->restore($id);

            return handleResponse('Class restored successfully.');

        } catch (Exception $e) {
            return handleResponse('Error occurred while restoring class: ' . $e->getMessage(), 'error');
        }
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();

            $this->sclClassRepository->forceDelete($id);

            DB::commit();

            return handleResponse('Class permanently deleted successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return handleResponse('Error occurred while permanently deleting class: ' . $e->getMessage(), 'error');
        }
    }

    public function bulkDestroy(Request $request)
    {
        try {
            DB::beginTransaction();

            $ids = explode(',', $request->ids);

            // Mark who deleted these items
            foreach ($ids as $id) {
                $sclClass = $this->sclClassRepository->find($id);
                $sclClass->update(['deleted_by' => Auth::id()]);
            }

            $this->sclClassRepository->delete($request->ids);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => count($ids) . ' classes deleted successfully.'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while deleting classes: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkRestore(Request $request)
    {
        try {
            DB::beginTransaction();

            $ids = explode(',', $request->ids);
            $count = 0;

            foreach ($ids as $id) {
                $this->sclClassRepository->restore($id);
                $count++;
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => $count . ' classes restored successfully.'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while restoring classes: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkForceDelete(Request $request)
    {
        try {
            DB::beginTransaction();

            $ids = explode(',', $request->ids);
            $count = 0;

            foreach ($ids as $id) {
                $this->sclClassRepository->forceDelete($id);
                $count++;
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => $count . ' classes permanently deleted successfully.'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Error occurred while permanently deleting classes: ' . $e->getMessage()
            ], 500);
        }
    }

    public function filter(Request $request)
    {
        // If using a custom filter handling method
        $dataTable = app(SclClassDataTable::class);

        // Apply trashed filter if provided
        if ($request->has('trashed')) {
            $dataTable->with('trashed', $request->trashed);
        }

        return $dataTable->render('admin.sclClass.index');
    }
}
