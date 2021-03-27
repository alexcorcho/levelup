<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Member;
use JavaScript;
use App\Enquiry;
use App\Invoice;
use App\Service;
use App\Setting;
use Carbon\Carbon;
use App\SmsTrigger;
use App\ChequeDetail;
use App\Subscription;
use App\InvoiceDetail;
use App\PaymentDetail;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar una lista del recurso.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $members = Member::indexQuery($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.index', compact('members', 'count', 'drp_placeholder', 'old_sort'));
    }

    public function active(Request $request)
    {
        $members = Member::active($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.active', compact('members', 'count', 'drp_placeholder', 'old_sort'));
    }

    public function inactive(Request $request)
    {
        $members = Member::inactive($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.inactive', compact('members', 'count', 'drp_placeholder', 'old_sort'));
    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('members.show', compact('member'));
    }

    /**
     * Mostrar el formulario para crear un nuevo recurso.
     *
     * @return Response
     */
    public function create()
    {
        // Para el cálculo de impuestos
        JavaScript::put([
            'taxes' => \Utilities::getSetting('taxes'),
            'gymieToday' => Carbon::today()->format('Y-m-d'),
            'servicesCount' => Service::count(),
        ]);

        //Obtener modo de numeración
        $invoice_number_mode = \Utilities::getSetting('invoice_number_mode');
        $member_number_mode = \Utilities::getSetting('member_number_mode');

        //Generando número de factura
        if ($invoice_number_mode == \constNumberingMode::Auto) {
            $invoiceCounter = \Utilities::getSetting('invoice_last_number') + 1;
            $invoicePrefix = \Utilities::getSetting('invoice_prefix');
            $invoice_number = $invoicePrefix.$invoiceCounter;
        } else {
            $invoice_number = '';
            $invoiceCounter = '';
        }

        //Generando contador de miembros
        if ($member_number_mode == \constNumberingMode::Auto) {
            $memberCounter = \Utilities::getSetting('member_last_number') + 1;
            $memberPrefix = \Utilities::getSetting('member_prefix');
            $member_code = $memberPrefix.$memberCounter;
        } else {
            $member_code = '';
            $memberCounter = '';
        }

        return view('members.create', compact('invoice_number', 'invoiceCounter', 'member_code', 'memberCounter', 'member_number_mode', 'invoice_number_mode'));
    }

    /**
     * Almacene un recurso recién creado
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Validación de modelo de miembro
        $this->validate($request, ['email' => 'unique:mst_members,email',
                                   'contact' => 'unique:mst_members,contact',
                                   'member_code' => 'unique:mst_members,member_code', ]);

        // Iniciar transacción
        DB::beginTransaction();

        try {
            //Almacenar los datos personales del miembro
            $memberData = ['name'=>$request->name,
                                    'DOB'=> $request->DOB,
                                    'gender'=> $request->gender,
                                    'contact'=> $request->contact,
                                    'emergency_contact'=> $request->emergency_contact,
                                    'health_issues'=> $request->health_issues,
                                    'email'=> $request->email,
                                    'address'=> $request->address,
                                    'member_id'=> $request->member_id,
                                    'proof_name'=> $request->proof_name,
                                    'member_code'=> $request->member_code,
                                    'status'=> $request->status,
                                    'pin_code'=> $request->pin_code,
                                    'occupation'=> $request->occupation,
                                    'aim'=> $request->aim,
                                    'source'=> $request->source, ];

            $member = new Member($memberData);
            $member->createdBy()->associate(Auth::user());
            $member->updatedBy()->associate(Auth::user());
            $member->save();

            // Agregar medios, es decir, perfil y foto de examen
            if ($request->hasFile('photo')) {
                $member->addMedia($request->file('photo'))->usingFileName('profile_'.$member->id.'.'.$request->photo->getClientOriginalExtension())->toCollection('profile');
            }

            if ($request->hasFile('proof_photo')) {
                $member->addMedia($request->file('proof_photo'))->usingFileName('proof_'.$member->id.'.'.$request->proof_photo->getClientOriginalExtension())->toCollection('proof');
            }

            // Función auxiliar para calcular el estado de pago
            $invoice_total = $request->admission_amount + $request->subscription_amount + $request->taxes_amount - $request->discount_amount;
            $paymentStatus = \constPaymentStatus::Unpaid;
            $pending = $invoice_total - $request->payment_amount;

            if ($request->mode == 1) {
                if ($request->payment_amount == $invoice_total) {
                    $paymentStatus = \constPaymentStatus::Paid;
                } elseif ($request->payment_amount > 0 && $request->payment_amount < $invoice_total) {
                    $paymentStatus = \constPaymentStatus::Partial;
                } elseif ($request->payment_amount == 0) {
                    $paymentStatus = \constPaymentStatus::Unpaid;
                } else {
                    $paymentStatus = \constPaymentStatus::Overpaid;
                }
            }

            // Almacenamiento de factura
            $invoiceData = ['invoice_number'=> $request->invoice_number,
                                     'member_id'=> $member->id,
                                     'total'=> $invoice_total,
                                     'status'=> $paymentStatus,
                                     'pending_amount'=> $pending,
                                     'discount_amount'=> $request->discount_amount,
                                     'discount_percent'=> $request->discount_percent,
                                     'discount_note'=> $request->discount_note,
                                     'tax'=> $request->taxes_amount,
                                     'additional_fees'=> $request->additional_fees,
                                     'note'=>' ', ];

            $invoice = new Invoice($invoiceData);
            $invoice->createdBy()->associate(Auth::user());
            $invoice->updatedBy()->associate(Auth::user());
            $invoice->save();

            // almacenamiento de suscripción
            foreach ($request->plan as $plan) {
                $subscriptionData = ['member_id'=> $member->id,
                                            'invoice_id'=> $invoice->id,
                                            'plan_id'=> $plan['id'],
                                            'start_date'=> $plan['start_date'],
                                            'end_date'=> $plan['end_date'],
                                            'status'=> \constSubscription::onGoing,
                                            'is_renewal'=>'0', ];

                $subscription = new Subscription($subscriptionData);
                $subscription->createdBy()->associate(Auth::user());
                $subscription->updatedBy()->associate(Auth::user());
                $subscription->save();

                //Agregar suscripción a la factura (Detalles de la factura)
                $detailsData = ['invoice_id'=> $invoice->id,
                                       'plan_id'=> $plan['id'],
                                       'item_amount'=> $plan['price'], ];

                $invoiceDetails = new InvoiceDetail($detailsData);
                $invoiceDetails->createdBy()->associate(Auth::user());
                $invoiceDetails->updatedBy()->associate(Auth::user());
                $invoiceDetails->save();
            }

            // Detalles de pago
            $paymentData = ['invoice_id'=> $invoice->id,
                                     'payment_amount'=> $request->payment_amount,
                                     'mode'=> $request->mode,
                                     'note'=> ' ', ];

            $paymentDetails = new PaymentDetail($paymentData);
            $paymentDetails->createdBy()->associate(Auth::user());
            $paymentDetails->updatedBy()->associate(Auth::user());
            $paymentDetails->save();

            if ($request->mode == 0) {
                // Detalles del cheque de la consignacion
                $chequeData = ['payment_id'=> $paymentDetails->id,
                                      'number'=> $request->number,
                                      'date'=> $request->date,
                                      'status'=> \constChequeStatus::Recieved, ];

                $cheque_details = new ChequeDetail($chequeData);
                $cheque_details->createdBy()->associate(Auth::user());
                $cheque_details->updatedBy()->associate(Auth::user());
                $cheque_details->save();
            }

            //  estado de consulta de actualización de transferencia de miembro
            if ($request->has('transfer_id')) {
                $enquiry = Enquiry::findOrFail($request->transfer_id);
                $enquiry->status = \constEnquiryStatus::Member;
                $enquiry->updatedBy()->associate(Auth::user());
                $enquiry->save();
            }

            //Actualización de contadores de numeración
            Setting::where('key', '=', 'invoice_last_number')->update(['value' => $request->invoiceCounter]);
            Setting::where('key', '=', 'member_last_number')->update(['value' => $request->memberCounter]);
            $sender_id = \Utilities::getSetting('sms_sender_id');
            $gym_name = \Utilities::getSetting('gym_name');

            //INICADOR de SMS - CODIGO COPIADO DE INTERNET
            if ($invoice->status == \constPaymentStatus::Paid) {
                $sms_trigger = SmsTrigger::where('alias', '=', 'member_admission_with_paid_invoice')->first();
                $message = $sms_trigger->message;
                $sms_text = sprintf($message, $member->name, $gym_name, $paymentDetails->payment_amount, $invoice->invoice_number);
                $sms_status = $sms_trigger->status;

                \Utilities::Sms($sender_id, $member->contact, $sms_text, $sms_status);
            } elseif ($invoice->status == \constPaymentStatus::Partial) {
                $sms_trigger = SmsTrigger::where('alias', '=', 'member_admission_with_partial_invoice')->first();
                $message = $sms_trigger->message;
                $sms_text = sprintf($message, $member->name, $gym_name, $paymentDetails->payment_amount, $invoice->invoice_number, $invoice->pending_amount);
                $sms_status = $sms_trigger->status;

                \Utilities::Sms($sender_id, $member->contact, $sms_text, $sms_status);
            } elseif ($invoice->status == \constPaymentStatus::Unpaid) {
                if ($request->mode == 0) {
                    $sms_trigger = SmsTrigger::where('alias', '=', 'payment_with_cheque')->first();
                    $message = $sms_trigger->message;
                    $sms_text = sprintf($message, $member->name, $paymentDetails->payment_amount, $cheque_details->number, $invoice->invoice_number, $gym_name);
                    $sms_status = $sms_trigger->status;

                    \Utilities::Sms($sender_id, $member->contact, $sms_text, $sms_status);
                } else {
                    $sms_trigger = SmsTrigger::where('alias', '=', 'member_admission_with_unpaid_invoice')->first();
                    $message = $sms_trigger->message;
                    $sms_text = sprintf($message, $member->name, $gym_name, $invoice->pending_amount, $invoice->invoice_number);
                    $sms_status = $sms_trigger->status;

                    \Utilities::Sms($sender_id, $member->contact, $sms_text, $sms_status);
                }
            }

            if ($subscription->start_date < $member->created_at) {
                $member->created_at = $subscription->start_date;
                $member->updated_at = $subscription->start_date;
                $member->save();

                $invoice->created_at = $subscription->start_date;
                $invoice->updated_at = $subscription->start_date;
                $invoice->save();

                foreach ($invoice->invoiceDetails as $invoiceDetail) {
                    $invoiceDetail->created_at = $subscription->start_date;
                    $invoiceDetail->updated_at = $subscription->start_date;
                    $invoiceDetail->save();
                }

                $paymentDetails->created_at = $subscription->start_date;
                $paymentDetails->updated_at = $subscription->start_date;
                $paymentDetails->save();

                $subscription->created_at = $subscription->start_date;
                $subscription->updated_at = $subscription->start_date;
                $subscription->save();
            }

            DB::commit();
            flash()->success('El miembro fue creado exitosamente');

            return redirect(action('MembersController@show', ['id' => $member->id]));
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error('Error al crear el miembro');

            return redirect(action('MembersController@index'));
        }
    }

    //Final

    // fin del metodo de almacenamiento

    /**
     * Edite un recurso creado
     *
     * @return Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $member_number_mode = \Utilities::getSetting('member_number_mode');
        $member_code = $member->member_code;

        return view('members.edit', compact('member', 'member_number_mode', 'member_code'));
    }

    /**
     * Editar un recurso
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $member = Member::findOrFail($id);
        $member->update($request->all());

        if ($request->hasFile('photo')) {
            $member->clearMediaCollection('profile');
            $member->addMedia($request->file('photo'))->usingFileName('profile_'.$member->id.'.'.$request->photo->getClientOriginalExtension())->toCollection('profile');
        }

        if ($request->hasFile('proof_photo')) {
            $member->clearMediaCollection('proof');
            $member->addMedia($request->file('proof_photo'))->usingFileName('proof_'.$member->id.'.'.$request->proof_photo->getClientOriginalExtension())->toCollection('proof');
        }

        $member->updatedBy()->associate(Auth::user());
        $member->save();

        flash()->success('Los detalles de los miembros se actualizaron correctamente');

        return redirect(action('MembersController@show', ['id' => $member->id]));
    }

    /**
     * Archivar un recurso
     *
     * @return Response
     */
    public function archive($id, Request $request)
    {
        Subscription::where('member_id', $id)->delete();

        $invoices = Invoice::where('member_id', $id)->get();

        foreach ($invoices as $invoice) {
            InvoiceDetail::where('invoice_id', $invoice->id)->delete();
            $paymentDetails = PaymentDetail::where('invoice_id', $invoice->id)->get();

            foreach ($paymentDetails as $paymentDetail) {
                ChequeDetail::where('payment_id', $paymentDetail->id)->delete();
                $paymentDetail->delete();
            }

            $invoice->delete();
        }

        $member = Member::findOrFail($id);
        $member->clearMediaCollection('profile');
        $member->clearMediaCollection('proof');

        $member->delete();

        return back();
    }

    public function transfer($id, Request $request)
    {
        // cálculo de impuestos
        JavaScript::put([
            'taxes' => \Utilities::getSetting('taxes'),
            'gymieToday' => Carbon::today()->format('Y-m-d'),
            'servicesCount' => Service::count(),
        ]);

        //Obtener modo de numeración
        $invoice_number_mode = \Utilities::getSetting('invoice_number_mode');
        $member_number_mode = \Utilities::getSetting('member_number_mode');

        //Generando número de factura
        if ($invoice_number_mode == \constNumberingMode::Auto) {
            $invoiceCounter = \Utilities::getSetting('invoice_last_number') + 1;
            $invoicePrefix = \Utilities::getSetting('invoice_prefix');
            $invoice_number = $invoicePrefix.$invoiceCounter;
        } else {
            $invoice_number = '';
            $invoiceCounter = '';
        }

        //Generando contador de miembros
        if ($member_number_mode == \constNumberingMode::Auto) {
            $memberCounter = \Utilities::getSetting('member_last_number') + 1;
            $memberPrefix = \Utilities::getSetting('member_prefix');
            $member_code = $memberPrefix.$memberCounter;
        } else {
            $member_code = '';
            $memberCounter = '';
        }

        $enquiry = Enquiry::findOrFail($id);

        return view('members.transfer', compact('enquiry', 'invoice_number', 'invoiceCounter', 'member_code', 'memberCounter', 'member_number_mode', 'invoice_number_mode'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function drpPlaceholder(Request $request)
    {
        if ($request->has('drp_start') and $request->has('drp_end')) {
            return $request->drp_start.' - '.$request->drp_end;
        }

        return 'Seleccionar  rango de fechas';
    }
}
