<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $settings = \Utilities::getSettings();

        return view('settings.show', compact('settings'));
    }

    public function edit()
    {
        $settings = \Utilities::getSettings();

        return view('settings.edit', compact('settings'));
    }

    public function save(Request $request)
    {
        // Obtenga todas las entradas para recorrer y guardar
        $settings = $request->except('_token');

        // Update All Settings
        foreach ($settings as $key => $value) {
            if ($key == 'gym_logo') {
                \Utilities::uploadFile($request, '', $key, 'gym_logo', \constPaths::GymLogo); // subir archivo
                $value = $key.'.jpg'; // Nombre de imagan para la DB
            }

            Setting::where('key', '=', $key)->update(['value' => $value]);
        }

        flash()->success('La configuración se actualizó correctamente');

        return redirect('settings/edit');
    }
}
