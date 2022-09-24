<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactThankyouEmail;

class LeadController extends Controller
{
    public function store(Request $request) {
        // mi prendo i dati inviati
        $data = $request->all();

        // controllo che siano validi
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max:60000'
        ]);

        // se la validazione fallisce
        if($validator->fails()) {
            //mi torno un json con success false
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // mi salvo i dati nel db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        //invio email di ringraziamente

        Mail::to($data['email'])->send(new ContactThankyouEmail());

        return response()->json([
            'success' => true
        ]);
    }
}
