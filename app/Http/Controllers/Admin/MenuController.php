<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Str;
class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menu.index');
    }
    public function fetchMenu()
    {
        try {
            $menu = Menu::orderBy('id','desc')->get();
            return FormatResponseJson::success($menu, 'menu berhasil diambil');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function storeMenu(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'url' => 'required|string',
                'icon' => 'required|string',
            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'url.required' => 'Link / Url tidak boleh kosong',
                'icon.required' => 'Icon tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $slug_name = Str::slug($request->name, '-');
            $menu = Menu::create([
                'name'=> $request->name,
                'url'=> $request->url,
                'slug' => $slug_name,
                'icon'=> $request->icon,
            ]);

            DB::commit();
            return FormatResponseJson::success($menu, 'menu berhasil dibuat');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);}
        catch (\Throwable $th) {
            DB::rollback();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function detailMenu(Request $request)
    {
        try {
            $menu = Menu::where('id', $request->id)->first();
            return FormatResponseJson::success($menu,'menu berhasil diambil');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function updateMenu(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'url' => 'required|string',
                'icon' => 'required|string',
            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'url.required' => 'Link / Url tidak boleh kosong',
                'icon.required' => 'Icon tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $slug_name = Str::slug($request->name, '-');
            $menu = Menu::find($request->id)->update([
                'name'=> $request->name,
                'url'=> $request->url,
                'slug' => $slug_name,
                'icon'=> $request->icon,
            ]);
            DB::commit();
            return FormatResponseJson::success($menu, 'menu berhasil diubah');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);}
        catch (\Throwable $th) {
            DB::rollback();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function storeSubMenu(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'url' => 'required|string',
                'icon' => 'required|string',
            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'url.required' => 'Link / Url tidak boleh kosong',
                'icon.required' => 'Icon tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $slug_name = Str::slug($request->name, '-');
            $submenu_data = [
                'menu_id'=> $request->id,
                'name'=> $request->name,
                'url'=> $request->url,
                'slug'=> $slug_name,
                'icon'=> $request->icon,
                'active'=> $request->active,
            ];
            $create_submenu = SubMenu::create($submenu_data);

            DB::commit();
            return FormatResponseJson::success($create_submenu, 'submenu berhasil dibuat');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);}
        catch (\Throwable $th) {
            DB::rollback();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function detailSubMenu(Request $request)
    {
        try {
            // dd($request->id);
            $submenus = SubMenu::where('menu_id', $request->id)->get();
            return FormatResponseJson::success($submenus,'submenu berhasil dimuat');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}
