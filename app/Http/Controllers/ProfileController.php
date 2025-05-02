<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, DocumentUpload};
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Helper;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    //
    public function profile()
    {
        if (Auth::user()->id == 1 && Auth::user()->role_id == 0) {
            $users = User::where('role_id', 1)
                ->orderBy('id', 'desc')
                ->get();
            $user = User::where('role_id', 0)
                ->where('id', Auth::user()->id)
                ->first();
            return view('profile.index', compact('user', 'users'));
        } elseif (Auth::user()->id != 1 && Auth::user()->role_id == 1) {

            if (Auth::user()->subparent_id == '' || Auth::user()->subparent_id == null) {
                $users = User::where('role_id', 1)
                    ->where('parent_id', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();
                $user = User::with([
                    'documents' => function ($query) {
                        $query->latest();
                    }
                ])
                    ->where('role_id', 1)
                    ->where('id', Auth::user()->id)
                    ->latest()
                    ->first();
                return view('profile.index', compact('user', 'users'));
            } else {
                $users = User::where('role_id', 1)
                    ->where('subparent_id', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();
                $user = User::with([
                    'documents' => function ($query) {
                        $query->latest();
                    }
                ])
                    ->where('role_id', 1)
                    ->where('id', Auth::user()->id)
                    ->first();
                return view('profile.index', compact('user', 'users'));
            }
        }

        return view('profile.index', compact('user', 'users'));
    }
    public function submitProfileUser(Request $request)
    { 
        // dd($request->all());
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
        if(isset($request->aadharcard)){
            $aadharcard = $request->file('aadharcard');
            $fileAadharExtension = $aadharcard->getClientOriginalExtension();
            $aadharcardFileName = time() . 'aadharcard_documents' . '.' . $fileAadharExtension;
            Storage::disk('s3')->put($awsDirectory . $aadharcardFileName, file_get_contents($aadharcard));
            $document_submit->aadharcard_document = $aadharcardFileName;
        }
         if(isset($request->otherdocument)){
            //other upload
            $other = $request->file('otherdocument');
            $otherFileExtension = $other->getClientOriginalExtension();
            $otherFileName = time() . 'other_documents' . '.' . $otherFileExtension;
            Storage::disk('s3')->put($awsDirectory . $otherFileName, file_get_contents($other));
            $document_submit->other_document = $otherFileName;
         }  
          if(isset($request->bankstatement)){
            //bank upload
            $bankstatement = $request->file('bankstatement');
            $bankFileExtension = $bankstatement->getClientOriginalExtension();
            $bankstatementFileName = time() . 'bank_documents' . '.' . $bankFileExtension;
            Storage::disk('s3')->put($awsDirectory . $bankstatementFileName, file_get_contents($bankstatement));
            $document_submit->bank_document = $bankstatementFileName;
          }
        $document_submit->save();
        return redirect()->route('user.profile');
    }
    public function documents(Request $request)
    {
        $documents = DocumentUpload::where('user_id', $request->user_id)
            ->latest()
            ->first();
        
       $user = User::where('id',$request->user_id)->first();
     
       if (isset($documents)) {
        $pancardDocument=null;
        $aadharDocument=null;
        $bankDocument=null;
        $otherDocument=null;
         if(!empty($documents->pancard_document) &&  $documents->pancard_document !=null){
             $pancardDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->pancard_document, now()->addMinutes(50));
            
           }
           if(!empty($documents->aadharcard_document) &&  $documents->aadharcard_document !=null){
            $aadharDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->aadharcard_document, now()->addMinutes(50));
           }
           if(!empty($documents->bank_document) &&  $documents->bank_document !=null){
            $bankDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->bank_document, now()->addMinutes(50));
           }
           if(!empty($documents->other_document) &&  $documents->other_document !=null){
            $otherDocument = Storage::disk('s3')->temporaryUrl('/regtechdoc' . $documents->other_document, now()->addMinutes(50));
           }
           return response()->json(['documents' => $documents, 'submit_date' => $documents->created_at, 'document_pancard' => $pancardDocument, 'aadhar_document' => $aadharDocument, 'bank_document' => $bankDocument, 'other_document' => $otherDocument,'user'=>$user]);
        } else {
          
            return response()->json(['user'=>$user]);
        }
    }
    public function submitProfileUsers(Request $request){
        dd($request->all());
       
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
         if(isset($request->aadharcard_docupload)){
            $aadharcard = $request->file('aadharcard_docupload');
            $fileAadharExtension = $aadharcard->getClientOriginalExtension();
            $aadharcardFileName = time() . 'aadharcard_documents' . '.' . $fileAadharExtension;
            Storage::disk('s3')->put($awsDirectory . $aadharcardFileName, file_get_contents($aadharcard));
            $document_submit->aadharcard_document = $aadharcardFileName;

         }
         if(isset($request->otherdocument_upload)){
             //other upload
             $other = $request->file('otherdocument_upload');
             $otherFileExtension = $other->getClientOriginalExtension();
             $otherFileName = time() . 'other_documents' . '.' . $otherFileExtension;
             Storage::disk('s3')->put($awsDirectory . $otherFileName, file_get_contents($other));
             $document_submit->other_document = $otherFileName;
 
         }
         if(isset($request->bankstatement_docupload)){
           //bank upload
            $bankstatement = $request->file('bankstatement_docupload');
            $bankFileExtension = $bankstatement->getClientOriginalExtension();
            $bankstatementFileName = time() . 'bank_documents' . '.' . $bankFileExtension;
            Storage::disk('s3')->put($awsDirectory . $bankstatementFileName, file_get_contents($bankstatement));
            $document_submit->bank_document = $bankstatementFileName;
         }
        $document_submit->save();
        return response()->json(['statusCode'=>200,'message'=>'Document Upload Successfully.']);
    }
}
