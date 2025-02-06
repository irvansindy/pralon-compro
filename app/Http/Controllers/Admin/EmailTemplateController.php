<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class EmailTemplateController extends Controller
{
    public function index()
    {
        return view('admin.mail.index');
    }
    public function fetch()
    {
        try {
            $templates = EmailTemplate::orderBy('id','desc')->get();
            return FormatResponseJson::success($templates, 'templates fetched successfully');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'type_email_template' => 'required|string',
                'name_email_template' => 'required|string',
                'subject_email_template' => 'required|string',
                'header_email_template' => 'required|string',
                'body_email_template' => 'required|string',
            ], [
                'type_email_template.required' => 'Type is required',
                'name_email_template.required' => 'Name is required',
                'subject_email_template.required' => 'Subject is required',
                'header_email_template.required' => 'Header is required',
                'body_email_template.required' => 'Body is required',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
    
            $data = [
                'email_type' => $request->type_email_template,
                'name' => $request->name_email_template,
                'subject' => $request->subject_email_template,
                'header' => $request->header_email_template,
                'body' => $request->body_email_template,
            ];

            $template = EmailTemplate::create($data);
            DB::commit();
            return FormatResponseJson::success($template, 'email template created successfully');
        } catch (ValidationException $e) {
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function detail(Request $request)
    {
        try {
            $template = EmailTemplate::findOrFail($request->id);
            return FormatResponseJson::success($template, 'email template fetched successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $template = EmailTemplate::findOrFail($request->id_email_template);
            $validator = Validator::make($request->all(), [
                'type_email_template' => 'required|string',
                'name_email_template' => 'required|string',
                'subject_email_template' => 'required|string',
                'header_email_template' => 'required|string',
                'body_email_template' => 'required|string',
            ], [
                'type_email_template.required' => 'Type is required',
                'name_email_template.required' => 'Name is required',
                'subject_email_template.required' => 'Subject is required',
                'header_email_template.required' => 'Header is required',
                'body_email_template.required' => 'Body is required',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
    
            $data = [
                'email_type' => $request->type_email_template,
                'name' => $request->name_email_template,
                'subject' => $request->subject_email_template,
                'header' => $request->header_email_template,
                'body' => $request->body_email_template,
            ];

            $template->update($data);
            DB::commit();
        } catch (ValidationException $e) {
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
