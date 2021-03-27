<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Member;
use App\Enquiry;
use App\Followup;
use App\SmsTrigger;
use Illuminate\Http\Request;

class EnquiriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $enquiries = Enquiry::indexQuery($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $enquiries->total();

        if (! $request->has('drp_start') or ! $request->has('drp_end')) {
            $drp_placeholder = 'Seleccionar  rango de fechas';
        } else {
            $drp_placeholder = $request->drp_start.' - '.$request->drp_end;
        }

        $request->flash();

        return view('enquiries.index', compact('enquiries', 'count', 'drp_placeholder'));
    }

    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $followups = $enquiry->followups->sortByDesc('updated_at');

        return view('enquiries.show', compact('enquiry', 'followups'));
    }

    public function create()
    {
        return view('enquiries.create');
    }

    public function store(Request $request)
    {
        // verificación de valores únicos
        $this->validate($request, ['email' => 'unique:mst_enquiries,email',
                                'contact' => 'unique:mst_enquiries,contact', ]);

        // Iniciar transacción
        DB::beginTransaction();

        try {
            // detalles de consultas 
            $enquiryData = ['name'=>$request->name,
                                    'DOB'=> $request->DOB,
                                    'gender'=> $request->gender,
                                    'contact'=> $request->contact,
                                    'email'=> $request->email,
                                    'address'=> $request->address,
                                    'status'=> \constEnquiryStatus::Lead,
                                    'pin_code'=> $request->pin_code,
                                    'occupation'=> $request->occupation,
                                    'start_by'=> $request->start_by,
                                    'interested_in'=> implode(',', $request->interested_in),
                                    'aim'=> $request->aim,
                                    'source'=> $request->source, ];

            $enquiry = new Enquiry($enquiryData);
            $enquiry->createdBy()->associate(Auth::user());
            $enquiry->updatedBy()->associate(Auth::user());
            $enquiry->save();

            //Almacenar los detalles
            $followupData = ['enquiry_id'=>$enquiry->id,
                                     'followup_by'=>$request->followup_by,
                                     'due_date'=>$request->due_date,
                                     'status'=> \constFollowUpStatus::Pending,
                                     'outcome'=>'', ];

            $followup = new Followup($followupData);
            $followup->createdBy()->associate(Auth::user());
            $followup->updatedBy()->associate(Auth::user());
            $followup->save();

            // INICIADOR DE SMS - CODIGO TOMADO DE INTNERT
            $gym_name = \Utilities::getSetting('gym_name');
            $sender_id = \Utilities::getSetting('sms_sender_id');

            $sms_trigger = SmsTrigger::where('alias', '=', 'enquiry_placement')->first();
            $message = $sms_trigger->message;
            $sms_text = sprintf($message, $enquiry->name, $gym_name);
            $sms_status = $sms_trigger->status;

            \Utilities::Sms($sender_id, $enquiry->contact, $sms_text, $sms_status);

            DB::commit();
            flash()->success('La llamada se creó con éxito.');

            return redirect(action('EnquiriesController@show', ['id' => $enquiry->id]));
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error('Error al crear reginstrar la llamada');

            return redirect(action('EnquiriesController@index'));
        }
    }

    // Fin del metodo

    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        return view('enquiries.edit', compact('enquiry'));
    }

    public function update($id, Request $request)
    {
        $enquiry = Enquiry::findOrFail($id);

        $enquiry->name = $request->name;
        $enquiry->DOB = $request->DOB;
        $enquiry->gender = $request->gender;
        $enquiry->contact = $request->contact;
        $enquiry->email = $request->email;
        $enquiry->address = $request->address;
        $enquiry->pin_code = $request->pin_code;
        $enquiry->occupation = $request->occupation;
        $enquiry->start_by = $request->start_by;
        $enquiry->interested_in = implode(',', $request->interested_in);
        $enquiry->aim = $request->aim;
        $enquiry->source = $request->source;
        $enquiry->createdBy()->associate(Auth::user());
        $enquiry->updatedBy()->associate(Auth::user());
        $enquiry->update();

        flash()->success('Los detalles de la llamada se actualizaron correctamente');

        return redirect(action('EnquiriesController@show', ['id' => $enquiry->id]));
    }

    public function lost($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $enquiry->status = \constEnquiryStatus::Lost;
        $enquiry->updatedBy()->associate(Auth::user());
        $enquiry->update();

        flash()->success('La llamada se marcó como perdida');

        return redirect('enquiries/all');
    }

    public function markMember($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $enquiry->status = \constEnquiryStatus::Member;
        $enquiry->updatedBy()->associate(Auth::user());
        $enquiry->update();

        flash()->success('La consulta se marcó como miembro');

        return redirect('enquiries/all');
    }
}
