<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePageSectionMaster;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
class HomePageController extends Controller
{
    public function index()
    {
        return view('admin.homepage.index');
    }
    public function fetchMasterSection()
    {
        try {
            $fetch_master_section = HomePageSectionMaster::all();
            return FormatResponseJson::success($fetch_master_section, 'Master section fetched successfully.');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeMasterSection(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'master_section_title' => 'required|string',
                'master_product_description' => 'required|string',
            ]);
            if ($validator->fails()) {
                DB::rollBack();
                throw new ValidationException($validator);
            }
            $data = [
                'user_id' => \auth()->user()->id,
                'title' => $request->master_section_title,
                'description' => $request->master_product_description,
            ];
            $create_master_section = HomePageSectionMaster::create($data);
            DB::commit();
            return FormatResponseJson::success($create_master_section,'Master section created successfully.');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchMasterSectionById(Request $request)
    {
        try {
            $fetch_master_section_by_id = HomePageSectionMaster::where('id', $request->master_section_id)->first();
            return FormatResponseJson::success($fetch_master_section_by_id,'Master section fetched successfully.');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateMasterSection(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request->all());
            $existing_data = HomePageSectionMaster::where('id', $request->master_section_id)->first();
            dd($existing_data);
            $validator = Validator::make($request->all(), [
                'master_section_title' => 'required|string',
                'master_product_description' => 'required|string',
            ]);
            if ($validator->fails()) {
                DB::rollBack();
                throw new ValidationException($validator);
            }
            DB::commit();
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
