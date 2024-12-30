<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\MasterAboutUs;
use App\Models\HistoryAboutUs;
use App\Models\WhyPralonAboutUs;
use App\Models\DetailWhyPralonAboutUs;
use App\Models\Vision;
use App\Models\Mision;
use App\Models\ValuePralonAboutUs;
use App\Models\Certificate;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use PHPUnit\Metadata\PreCondition;
class AboutUsController extends Controller
{
    public function index()
    {
        return view('admin.about_us.index');
    }
    public function fetchAllContentAboutUs()
    {
        try {
            $header = MasterAboutUs::first();
            $history = HistoryAboutUs::first();
            $why_pralon = WhyPralonAboutUs::with(['detail'])->first();
            $vision_mision = Vision::with(['mision'])->first();
            $value_pralon = ValuePralonAboutUs::all();
            $certificates = Certificate::all();
            // data to json
            $data = [
                'header' => $header,
                'history' => $history,
                'why_pralon' => $why_pralon,
                'vision_mision' => $vision_mision,
                // 'mision' => count($mision) == 0 ? null : $mision,
                'value_pralon' => count($value_pralon) == 0 ? null : $value_pralon,
                'certificates' => count($certificates) == 0 ? null : $certificates,
            ];
            return FormatResponseJson::success($data, 'fetched successfully.');
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchDetailHeaderAboutUs(Request $request)
    {
        try {
            $id = $request->id;
            $id != null ? $header = MasterAboutUs::findOrFail($request->id) : $header = null;
            $header == null ? $message = 'Header about us is empty' : $message = 'Header about us fetched succesfully';
            return FormatResponseJson::success($header,$message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeHeader(Request $request)
    {
        try {
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'header_name' => 'required|string',
                'header_title' => 'required|string',
                'header_link' => 'required|string',
                'header_version' => 'required|string',
            ]);

            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            $data = [
                'name' => $request->header_name,
                'title' => $request->header_title,
                'link' => $request->header_link,
                'version' => $request->header_version,
            ];
            $create_header = MasterAboutUs::create($data);
            DB::commit();
            return FormatResponseJson::success($create_header, 'header created successfully');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateHeader(Request $request)
    {
        try {
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'header_name' => 'required|string',
                'header_title' => 'required|string',
                'header_link' => 'required|string',
                'header_version' => 'required|string',
            ]);

            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            $existing_header = MasterAboutUs::find($request->header_id);
            $data = [
                'name' => $request->header_name,
                'title' => $request->header_title,
                'link' => $request->header_link,
                'version' => $request->header_version,
            ];
            if ($existing_header) {
                $existing_header->update($data);
            }
            
            DB::commit();
            return FormatResponseJson::success($existing_header, 'header updated successfully');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchDetailHistory(Request $request)
    {
        try {
            $id = $request->id;
            $id != null ? $history = HistoryAboutUs::findOrFail($request->id) : $history = null;
            $history == null ? $message = 'history about us is empty' : $message = 'history about us fetched succesfully';
            return FormatResponseJson::success($history,$message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeHistory(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'history_title' => 'required|string',
                'history_subtitle' => 'required|string',
                'history_source_thumbnail_video' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'history_source_video' => 'required|string',
                'history_desc' => 'required|string',
            ]);
            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            // history thumbnail image
            $file_history_source_thumbnail_video = $request->file('history_source_thumbnail_video');
            $slug_name = Str::slug($request->history_title.' thumbnail_video', '-');
            $file_history_source_thumbnail_video_name = $slug_name.'.'.$file_history_source_thumbnail_video->getClientOriginalExtension();

            $data = [
                'title' => $request->history_title,
                'subtitle' => $request->history_subtitle,
                'desc' => $request->history_desc,
                'source_thumbnail_video' => 'storage/uploads/thumbnail_video/'.$file_history_source_thumbnail_video_name,
                'source_video' => $request->history_source_video,
                'link' => $request->history_link,
            ];

            $create_history = HistoryAboutUs::create($data);
            if($create_history) {
                $file_history_source_thumbnail_video->move(public_path('storage/uploads/thumbnail_video/'), $file_history_source_thumbnail_video_name);
            }
            DB::commit();
            return FormatResponseJson::success($create_history, 'history about us created successfully.');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateHistory(Request $request)
    {
        try {
            // dd($request->all());
            $validation = Validator::make($request->all(), [
                'history_title' => 'required|string',
                'history_subtitle' => 'required|string',
                // 'history_source_thumbnail_video' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'history_source_video' => 'required|string',
                'history_desc' => 'required|string',
            ]);
            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            $existing_history = HistoryAboutUs::find($request->history_id);
            $data = [
                'title' => $request->history_title,
                'subtitle' => $request->history_subtitle,
                'desc' => $request->history_desc,
                // 'source_thumbnail_video' => 'storage/uploads/thumbnail_video/'.$file_history_source_thumbnail_video_name,
                'source_video' => $request->history_source_video,
                'link' => $request->history_link,
            ];
            if($existing_history) {
                $existing_history->update($data);
            }
            if ($request->history_source_thumbnail_video != null) {
                // check existing master image
                $old_source_thumbnail_video_path = public_path($existing_history->source_thumbnail_video);
                if (file_exists($old_source_thumbnail_video_path)) {
                    unlink($old_source_thumbnail_video_path);
                }
                
                // history thumbnail image
                $file_history_source_thumbnail_video = $request->file('history_source_thumbnail_video');
                $slug_name = Str::slug($request->history_title.' thumbnail_video', '-');
                $file_history_source_thumbnail_video_name = $slug_name.'.'.$file_history_source_thumbnail_video->getClientOriginalExtension();
                $existing_history->update([
                    'source_thumbnail_video' => 'storage/uploads/thumbnail_video/'.$file_history_source_thumbnail_video_name,
                ]);
                $file_history_source_thumbnail_video->move(public_path('storage/uploads/thumbnail_video/'), $file_history_source_thumbnail_video_name);
            }
            DB::commit();
            return FormatResponseJson::success($existing_history, 'history about us updated successfully.');
            
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchDetailWhyPralon(Request $request)
    {
        try {
            $id = $request->id;
            $id != null ? $why_pralon = WhyPralonAboutUs::with(['detail'])->findOrFail($request->id) : $why_pralon = null;
            $why_pralon == null ? $message = 'reason about us is empty' : $message = 'reason about us fetched succesfully';
            return FormatResponseJson::success($why_pralon,$message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeWhyPralon(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'why_pralon_title' => 'required|string',
                'why_pralon_subtitle' => 'required|string',
                'why_pralon_desc' => 'required|string',
                'why_pralon_image' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'detail_why_pralon_title.*' => 'required|string',
                'detail_why_pralon_icon.*' => 'required|string',
                'detail_why_pralon_desc.*' => 'required|string',
            ]);
            
            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }

            // why image
            $file_why_pralon_image = $request->file('why_pralon_image');
            $slug_name = Str::slug($request->why_pralon_title.' why_pralon_image', '-');
            $file_why_pralon_image_name = $slug_name.'.'.$file_why_pralon_image->getClientOriginalExtension();
            
            $data_master = [
                'title' => $request->why_pralon_title,
                'subtitle' => $request->why_pralon_subtitle,
                'desc' => $request->why_pralon_desc,
                'image' => 'storage/uploads/why_pralon_image/'.$file_why_pralon_image_name,
            ];
            $create_why_pralon = WhyPralonAboutUs::create($data_master);
            if($create_why_pralon) {
                $file_why_pralon_image->move(public_path('storage/uploads/why_pralon_image/'), $file_why_pralon_image_name);
            }

            if (count($request->detail_why_pralon_title) > 0) {
                $array_detail = [];
                $data_detail = [];
                for ($i=0; $i < count($request->detail_why_pralon_title); $i++) { 
                    $data_detail = [
                        'history_about_us_id' => $create_why_pralon->id,
                        'title' => $request->detail_why_pralon_title[$i],
                        'desc' => $request->detail_why_pralon_desc[$i],
                        'icon' => $request->detail_why_pralon_icon[$i],
                    ];
                    array_push($array_detail, $data_detail);
                }
                $create_detail = DetailWhyPralonAboutUs::insert($array_detail);
            }
            
            DB::commit();
            return FormatResponseJson::success( $create_why_pralon, 'reason about us created.');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateWhyPralon(Request $request){
        try {
            // dd($request->all());
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'why_pralon_title' => 'required|string',
                'why_pralon_subtitle' => 'required|string',
                'why_pralon_desc' => 'required|string',
                'why_pralon_image' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'detail_why_pralon_title.*' => 'required|string',
                'detail_why_pralon_icon.*' => 'required|string',
                'detail_why_pralon_desc.*' => 'required|string',
            ]);
            
            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }

            $existing_data = WhyPralonAboutUs::findOrFail( $request->why_pralon_id);
            $data = [
                'title' => $request->why_pralon_title,
                'subtitle' => $request->why_pralon_subtitle,
                'desc' => $request->why_pralon_desc,
            ];

            if ($existing_data) {
                $existing_data->update($data);
            }

            if ($request->why_pralon_image != null) {
                // check existing master image
                $old_why_pralon_image_path = public_path($existing_data->image);
                // dd($old_why_pralon_image_path);
                if (file_exists($old_why_pralon_image_path)) {
                    unlink($old_why_pralon_image_path);
                }
                // history thumbnail image
                $file_why_pralon_image = $request->file('why_pralon_image');
                $slug_name = Str::slug($request->why_pralon_title.' why_pralon_image', '-');
                $file_why_pralon_image_name = $slug_name.'.'.$file_why_pralon_image->getClientOriginalExtension();

                $existing_data->update([
                    'image' => 'storage/uploads/why_pralon_image/'.$file_why_pralon_image_name,
                ]);
                $file_why_pralon_image->move(public_path('storage/uploads/why_pralon_image/'), $file_why_pralon_image_name);
            }

            if (count($request->detail_why_pralon_title) > 0) {
                DetailWhyPralonAboutUs::where('history_about_us_id', $existing_data->id)->delete();
                $array_detail = [];
                $data_detail = [];
                for ($i=0; $i < count($request->detail_why_pralon_title); $i++) { 
                    $data_detail = [
                        'history_about_us_id' => $existing_data->id,
                        'title' => $request->detail_why_pralon_title[$i],
                        'desc' => $request->detail_why_pralon_desc[$i],
                        'icon' => $request->detail_why_pralon_icon[$i],
                    ];
                    array_push($array_detail, $data_detail);
                }
                $create_detail = DetailWhyPralonAboutUs::insert($array_detail);
            }
            DB::commit();
            return FormatResponseJson::success($create_detail, 'reason about us updated');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchVisiMisi(Request $request)
    {
        try {
            $id = $request->id;
            $id != null ? $visi_misi = Vision::with(['mision'])->findOrFail($request->id) : $visi_misi = null;
            $visi_misi == null ? $message = 'visi misi about us is empty' : $message = 'visi misi about us fetched succesfully';
            return FormatResponseJson::success($visi_misi,$message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeVisiMisi(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'visi' => 'required|string',
                'visi_misi_image' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'list_misi.*' => 'required|string',
            ]);
            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            // visi image
            $file_visi_misi_image = $request->file('visi_misi_image');
            $slug_name = Str::slug($request->why_pralon_title.' visi_misi_image', '-');
            $file_visi_misi_image_name = $slug_name.'.'.$file_visi_misi_image->getClientOriginalExtension();
            // visi_misi_image
            $data_visi = [
                'text' => $request->visi,
                'image' => 'storage/uploads/visi_misi_image/'.$file_visi_misi_image_name,
            ];
            $create_visi = Vision::create($data_visi);
            if ($create_visi) {
                $file_visi_misi_image->move(public_path('storage/uploads/visi_misi_image/'), $file_visi_misi_image_name);
            }

            if (count($request->list_misi) > 0) {
                $array_misi = [];
                $data_misi = [];
                for ($i=0; $i < count($request->list_misi); $i++) { 
                    $data_misi = [
                        'vision_id' => $create_visi->id,
                        'number' => $i+1,
                        'text' => $request->list_misi[$i],
                    ];
                    array_push($array_misi, $data_misi);
                }
                $create_misi = Mision::insert($array_misi);
            }
            DB::commit();
            return FormatResponseJson::success([$create_visi, $create_misi], 'Visi Misi created');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateVisiMisi(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'visi' => 'required|string',
                // 'visi_misi_image' => 'required|image|max:10000|mimes:jpg,jpeg,png',
                'list_misi.*' => 'required|string',
            ]);

            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            $existing_visi = Vision::where('id', $request->visi_id)->first();
            
            $data_visi = [
                'text' => $request->visi,
                // 'image' => 'storage/uploads/visi_misi_image/'.$file_visi_misi_image_name,
            ];
            if ($existing_visi) {
                $existing_visi->update($data_visi);
            }

            if ($request->visi_misi_image != null) {
                // check existing master image
                $old_visi_misi_image_path = public_path($existing_visi->image);
                // dd($old_visi_misi_image_path);
                if (file_exists($old_visi_misi_image_path)) {
                    unlink($old_visi_misi_image_path);
                }

                // visi image
                $file_visi_misi_image = $request->file('visi_misi_image');
                $slug_name = Str::slug($request->why_pralon_title.' visi_misi_image', '-');
                $file_visi_misi_image_name = $slug_name.'.'.$file_visi_misi_image->getClientOriginalExtension();

                $existing_visi->update([
                    'image' => 'storage/uploads/visi_misi_image/'.$file_visi_misi_image_name,
                ]);
                $file_visi_misi_image->move(public_path('storage/uploads/visi_misi_image/'), $file_visi_misi_image_name);
            }

            if (count($request->list_misi) > 0) {
                Mision::where('vision_id', $existing_visi->id)->delete();
                $array_misi = [];
                $data_misi = [];
                for ($i=0; $i < count($request->list_misi); $i++) { 
                    $data_misi = [
                        'vision_id' => $existing_visi->id,
                        'number' => $i+1,
                        'text' => $request->list_misi[$i],
                    ];
                    array_push($array_misi, $data_misi);
                }
                $create_misi = Mision::insert($array_misi);
            }
            DB::commit();
            return FormatResponseJson::success( [$existing_visi, $create_misi], 'visi misi updated');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchValue(Request $request)
    {
        // ValuePralonAboutUs
        try {
            $value = ValuePralonAboutUs::all();
            $message = count($value) <= 0 ? 'value about us is empty' : 'value about us fetched succesfully';
            $data = count($value) <= 0 ? null : $value;
            return FormatResponseJson::success($data,$message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeValue(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'value_name.*' => 'required|string',
                'value_icon.*' => 'required|string',
            ]);
            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            if (count($request->value_name) != 0 || count($request->value_icon) != 0) {
                $array_value = [];
                $value_data = [];
                for ($i=0; $i < count($request->value_name); $i++) { 
                    $value_data = [
                        'name' => $request->value_name[$i],
                        'icon' => $request->value_icon[$i],
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    array_push($array_value, $value_data);
                }
                $create_value = ValuePralonAboutUs::insert($array_value);
            }
            DB::commit();
            return FormatResponseJson::success($create_value, 'values created');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function updateValue(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'value_name.*' => 'required|string',
                'value_icon.*' => 'required|string',
            ]);
            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            if (count($request->value_name) != 0 || count($request->value_icon) != 0) {
                ValuePralonAboutUs::all()->each->delete();
                $array_value = [];
                $value_data = [];
                for ($i=0; $i < count($request->value_name); $i++) { 
                    $value_data = [
                        'name' => $request->value_name[$i],
                        'icon' => $request->value_icon[$i],
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    array_push($array_value, $value_data);
                }
                $create_value = ValuePralonAboutUs::insert($array_value);
            }
            DB::commit();
            return FormatResponseJson::success($create_value, 'value updated');
        } catch (ValidationException $e) {
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchCertificates(Request $request)
    {
        try {
            $certificates = Certificate::all();
            $data = count($certificates) <=0 ? null : $certificates;
            $message = count($certificates) <= 0 ? 'certificates about us is empty' : 'certificates about us fetched succesfully';
            return FormatResponseJson::success($data,$message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function storeCertificate(Request $request)
    {
        try {
            // dd($request->file('input-multiple-file'));
            DB::beginTransaction();
            $validation = Validator::make($request->all(), [
                'input-multiple-file.*' => 'required|image|max:10000|mimes:jpg,jpeg,png',
            ]);
            if ($validation->fails()) {
                DB::rollBack();
                throw new ValidationException($validation);
            }
            if (count($request->file('input-multiple-file')) > 0) {
                for ($i=0; $i < count($request->file('input-multiple-file')); $i++) { 
                    # code...
                    $file_certificate_icon = $request->file('input-multiple-file')[$i];
                    $slug_name = Str::slug($file_certificate_icon->getClientOriginalName().' certificate_icon', '-');
                    $file_certificate_icon_name = $slug_name.'.'.$file_certificate_icon->getClientOriginalExtension();
                    // dd($file_certificate_icon->getClientOriginalName());
                    $data_certificate = [
                        'title' => $file_certificate_icon_name,
                        'desc' => null,
                        'icon' => 'storage/uploads/certificate_icon/'.$file_certificate_icon_name
                    ];
                    $create_certificate = Certificate::create($data_certificate);
                    if ($create_certificate) {
                        $file_certificate_icon->move(public_path('storage/uploads/certificate_icon/'), $file_certificate_icon_name);
                    }
                }
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'File yang diupload minimal 1');
                // return FormatResponseJson::error(null,'File yang diupload minimal 1');
            }
            DB::commit();
            // return FormatResponseJson::success($create_certificate, 'Certificate created');
            return redirect()->route('about-us-setting')->with('success', 'Certificate created successfully');
        } catch (ValidationException $e) {
            DB::rollback();
            // return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            // return FormatResponseJson::error(null, $e->getMessage(), 500);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
