<?php

namespace App\Http\Controllers;

use App\Models\{User, DocumentUpload};
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProfileController1 extends Controller
{

    // public function getCurrentUserWithUploadedDocument($token)
    // {
    //     if (is_numeric($token)) {
    //         $user = User::where('id', $token)->first();
    //     } else {
    //         $user = User::where('access_token', $token)->first();
    //     }

    //     if (!$user) {
    //         return null;
    //     }
    //     $document = DocumentUpload::where('user_id', $user->id)->get();
    //     return $document;
    //     if ($document) {
    //         $user->pancard_document = $document->pancard_document;
    //         $user->bank_document = $document->bank_document;
    //         $user->aadharcard_document = $document->aadharcard_document;
    //         $user->other_document = $document->other_document;
    //     }

    //     return $user;
    // }


    //     public function getCurrentUserWithUploadedDocument($token)
// {
//     if (is_numeric($token)) {
//         $user = User::where('id', $token)->first();
//     } else {
//         $user = User::where('access_token', $token)->first();
//     }

    //     if (!$user) {
//         return null;
//     }

    //     $document = DocumentUpload::where('user_id', $user->id)->latest()->first();

    //     $user->document = $document;

    //     return $user;
// }


    // public function getCurrentUserWithUploadedDocument($token)
    // {
    //     if (is_numeric($token)) {
    //         $user = User::where('id', $token)->first();
    //     } else {
    //         $user = User::where('access_token', $token)->first();
    //     }

    //     if (!$user) {
    //         return response()->json(['error' => 'User not found'], 404);
    //     }

    //     $documents = DocumentUpload::where('user_id', $user->id)->latest()->first();

    //     if (isset($documents)) {
    //         $pancardDocument = null;
    //         $aadharDocument = null;
    //         $bankDocument = null;
    //         $otherDocument = null;
    //         if (!empty($documents->pancard_document) && $documents->pancard_document != null) {
    //             $pancardDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->pancard_document, now()->addMinutes(50));

    //         }
    //         if (!empty($documents->aadharcard_document) && $documents->aadharcard_document != null) {
    //             $aadharDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->aadharcard_document, now()->addMinutes(50));
    //         }
    //         if (!empty($documents->bank_document) && $documents->bank_document != null) {
    //             $bankDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->bank_document, now()->addMinutes(50));
    //         }
    //         if (!empty($documents->other_document) && $documents->other_document != null) {
    //             $otherDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->other_document, now()->addMinutes(50));
    //         }
    //         return response()->json(['documents' => $documents, 'submit_date' => $documents->created_at, 'document_pancard' => $pancardDocument, 'aadhar_document' => $aadharDocument, 'bank_document' => $bankDocument, 'other_document' => $otherDocument, 'user' => $user]);
    //     } else {

    //         return response()->json(['user' => $user]);
    //     }

    //     $user->pancard_document = $pancardDocument;
    //     $user->bank_document = $document->$bankDocument;
    //     $user->aadharcard_document = $document->$aadharDocument;
    //     $user->other_document = $document->$otherDocument;

    //     // $user->document = $document;

    //     return $user;
    // }









    public function getCurrentUserWithUploadedDocument($token)
    {
        // Find the user by ID or access token
        if (is_numeric($token)) {
            $user = User::where('id', $token)->first();
        } else {
            $user = User::where('access_token', $token)->first();
        }
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $documents = DocumentUpload::where('user_id', $user->id)->latest()->first();

        $pancardDocument = null;
        $aadharDocument = null;
        $bankDocument = null;
        $otherDocument = null;

        if (isset($documents)) {
            if (!empty($documents->pancard_document)) {
                $pancardDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->pancard_document, now()->addMinutes(50));
            }
            if (!empty($documents->aadharcard_document)) {
                $aadharDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->aadharcard_document, now()->addMinutes(50));
            }
            if (!empty($documents->bank_document)) {
                $bankDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->bank_document, now()->addMinutes(50));
            }
            if (!empty($documents->other_document)) {
                $otherDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->other_document, now()->addMinutes(50));
            }
        }

        // Prepare the response data
        $response = [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'type' => $user->type,
                'access_token' => $user->access_token,
                'salt_key' => $user->salt_key,
                'role_id' => $user->role_id,
                'status' => $user->status,
                'verified' => $user->verified,
                'amount_paid' => $user->amount_paid,
                'payment_date' => $user->payment_date,
                'topup_amount' => $user->topup_amount,
                'topup_date' => $user->topup_date,
                'wallet_amount' => $user->wallet_amount,
                'one_time_comission' => $user->one_time_comission,
                'scheme_type' => $user->scheme_type,
                'scheme_type_id' => $user->scheme_type_id,
                'scheme_hit_count' => $user->scheme_hit_count,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'parent_id' => $user->parent_id,
                'subparent_id' => $user->subparent_id,
            ],
            'documents' => [
                'id' => $documents->id ?? null,
                'user_id' => $documents->user_id ?? null,
                'submit_date' => $documents->created_at ?? null,
                'pancard_document' => $pancardDocument,
                'aadhar_document' => $aadharDocument,
                'bank_document' => $bankDocument,
                'other_document' => $otherDocument,
            ]
        ];

        // Return the response as JSON
        return response()->json($response);
    }


    public function getAllUserWithUploadedDocument($token)
{
    // Find the user by access token
    $user = User::where('access_token', $token)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Determine which users to fetch based on the role of the current user
    if ($user->role_id == 0) {
        // Fetch all users with role_id = 1
        $users = User::where('role_id', 1)->orderBy('id', 'desc')->get();
    } else {
        // Fetch users with the subparent_id matching the current user id
        $users = User::where('subparent_id', $user->id)->orderBy('id', 'desc')->get();
    }

    // Prepare the response data
    $response = $users->map(function ($user) {
        // Fetch the documents for the current user
        $documents = DocumentUpload::where('user_id', $user->id)->latest()->first();

        $pancardDocument = null;
        $aadharDocument = null;
        $bankDocument = null;
        $otherDocument = null;

        if ($documents) {
            if (!empty($documents->pancard_document)) {
                $pancardDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->pancard_document, now()->addMinutes(50));
            }
            if (!empty($documents->aadharcard_document)) {
                $aadharDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->aadharcard_document, now()->addMinutes(50));
            }
            if (!empty($documents->bank_document)) {
                $bankDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->bank_document, now()->addMinutes(50));
            }
            if (!empty($documents->other_document)) {
                $otherDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->other_document, now()->addMinutes(50));
            }
        }

        // Build the user and documents response
        return [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'type' => $user->type,
                'access_token' => $user->access_token,
                'salt_key' => $user->salt_key,
                'role_id' => $user->role_id,
                'status' => $user->status,
                'verified' => $user->verified,
                'amount_paid' => $user->amount_paid,
                'payment_date' => $user->payment_date,
                'topup_amount' => $user->topup_amount,
                'topup_date' => $user->topup_date,
                'wallet_amount' => $user->wallet_amount,
                'one_time_comission' => $user->one_time_comission,
                'scheme_type' => $user->scheme_type,
                'scheme_type_id' => $user->scheme_type_id,
                'scheme_hit_count' => $user->scheme_hit_count,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'parent_id' => $user->parent_id,
                'subparent_id' => $user->subparent_id,
            ],
            'documents' => [
                'id' => $documents->id ?? null,
                'user_id' => $documents->user_id ?? null,
                'submit_date' => $documents->created_at ?? null,
                'pancard_document' => $pancardDocument,
                'aadhar_document' => $aadharDocument,
                'bank_document' => $bankDocument,
                'other_document' => $otherDocument,
            ]
        ];
    });

    // Return the response as JSON
    return response()->json($response);
}



    public function updateProfileUser(Request $request)
    {
        $pancardFileName = null;
        $aadharcardFileName = null;
        $bankstatementFileName = null;
        $otherFileName = null;
        $awsDirectory = '/regtechdoc';
        $user = User::where('id', $request->user_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $document_submit = new DocumentUpload();
        $document_submit->user_id = $request->user_id;
        $document_submit->created_at = Carbon::now();
        $document_submit->updated_at = Carbon::now();
        $document_submit->save();
        if (isset($request->pancard)) {
            $pancard = $request->file('pancard');
            $filePanExtension = $pancard->getClientOriginalExtension();
            $pancardFileName = time() . 'pancard_documents' . '.' . $filePanExtension;
            Storage::disk('s3')->put($awsDirectory . $pancardFileName, file_get_contents($pancard));
            $document_submit->pancard_document = $pancardFileName;
        }
        if (isset($request->aadharcard)) {
            $aadharcard = $request->file('aadharcard');
            $fileAadharExtension = $aadharcard->getClientOriginalExtension();
            $aadharcardFileName = time() . 'aadharcard_documents' . '.' . $fileAadharExtension;
            Storage::disk('s3')->put($awsDirectory . $aadharcardFileName, file_get_contents($aadharcard));
            $document_submit->aadharcard_document = $aadharcardFileName;
        }
        if (isset($request->otherdocument)) {
            //other upload
            $other = $request->file('otherdocument');
            $otherFileExtension = $other->getClientOriginalExtension();
            $otherFileName = time() . 'other_documents' . '.' . $otherFileExtension;
            Storage::disk('s3')->put($awsDirectory . $otherFileName, file_get_contents($other));
            $document_submit->other_document = $otherFileName;
        }
        if (isset($request->bankstatement)) {
            //bank upload
            $bankstatement = $request->file('bankstatement');
            $bankFileExtension = $bankstatement->getClientOriginalExtension();
            $bankstatementFileName = time() . 'bank_documents' . '.' . $bankFileExtension;
            Storage::disk('s3')->put($awsDirectory . $bankstatementFileName, file_get_contents($bankstatement));
            $document_submit->bank_document = $bankstatementFileName;
        }
        $document_submit->save();
        return response()->json(['success' => 'Profile Updated Successfully'], 200);
    }


    public function updateProfileUsers(Request $request)
    {

        dd($request->all());
        $pancardFileName = null;
        $aadharcardFileName = null;
        $bankstatementFileName = null;
        $otherFileName = null;
        $awsDirectory = '/regtechdoc';
        $user = User::where('id', $request->user_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $document_submit = new DocumentUpload();
        $document_submit->user_id = $request->user_id;
        $document_submit->created_at = Carbon::now();
        $document_submit->updated_at = Carbon::now();
        $document_submit->save();
        if (isset($request->pancard_docupload)) {
            $pancard = $request->file('pancard_docupload');
            $filePanExtension = $pancard->getClientOriginalExtension();
            $pancardFileName = time() . 'pancard_documents' . '.' . $filePanExtension;
            Storage::disk('s3')->put($awsDirectory . $pancardFileName, file_get_contents($pancard));
            $document_submit->pancard_document = $pancardFileName;
        }
        if (isset($request->aadharcard_docupload)) {
            $aadharcard = $request->file('aadharcard_docupload');
            $fileAadharExtension = $aadharcard->getClientOriginalExtension();
            $aadharcardFileName = time() . 'aadharcard_documents' . '.' . $fileAadharExtension;
            Storage::disk('s3')->put($awsDirectory . $aadharcardFileName, file_get_contents($aadharcard));
            $document_submit->aadharcard_document = $aadharcardFileName;

        }
        if (isset($request->otherdocument_upload)) {
            //other upload
            $other = $request->file('otherdocument_upload');
            $otherFileExtension = $other->getClientOriginalExtension();
            $otherFileName = time() . 'other_documents' . '.' . $otherFileExtension;
            Storage::disk('s3')->put($awsDirectory . $otherFileName, file_get_contents($other));
            $document_submit->other_document = $otherFileName;

        }
        if (isset($request->bankstatement_docupload)) {
            //bank upload
            $bankstatement = $request->file('bankstatement_docupload');
            $bankFileExtension = $bankstatement->getClientOriginalExtension();
            $bankstatementFileName = time() . 'bank_documents' . '.' . $bankFileExtension;
            Storage::disk('s3')->put($awsDirectory . $bankstatementFileName, file_get_contents($bankstatement));
            $document_submit->bank_document = $bankstatementFileName;
        }
        $document_submit->save();
        return response()->json(['statusCode' => 200, 'message' => 'Document Upload Successfully.']);
    }


}
