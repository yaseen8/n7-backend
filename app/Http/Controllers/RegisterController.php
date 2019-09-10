<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUserModel\User;
use App\Models\AppUserCompanyModel\UserCompany;
use App\Models\AppPaymentModeModel\PaymentMode;
use App\Models\AppTaxDetailModel\TaxDetail;
use App\Models\AppSuperannuationModel\Superannuation;
use App\Models\AppSecurityLicenceModel\SecurityLicence;
use App\Models\AppDrivingLicenceModel\DrivingLicence;

class RegisterController extends Controller
{

    public function check_user_email(Request $request)
    {
        $email = $request->input('email');
        $check_mail = User::where('email' , $email)->get();
        if($check_mail) {
            return response()->json($check_mail, 200);
        }
        return response()->json('not found',404);
    }

    public function register(Request $request)
    {
        $user = User::create(
            [
                'name' => $request->input('user')['name'],
                'surname' => $request->input('user')['surname'],
                'password' => $request->input('user')['password'],
                'email' => $request->input('user')['email'],
                'dob' => $request->input('user')['dob'],
                'mobile' => $request->input('user')['mobile'],
                'address' => $request->input('user')['address'],
                'nok_name' => $request->input('user')['nok_name'],
                'nok_contact' => $request->input('user')['nok_contact'],
                'user_type' => $request->input('user')['user_type'],
            ]
            );
        if($user) {
            $user_company = UserCompany::create(
                [
                    'fk_company_id' => $request->input('company')['fk_company_id'],
                    'hire' => $request->input('company')['hire'],
                    'fk_user_id' => $user->id
                ]
                );
            $payment_mode = PaymentMode::create(
                [
                    'bank_name' => $request->input('payment_mode')['bank_name'],
                    'bsb_number' => $request->input('payment_mode')['bsb_number'],
                    'account_number' => $request->input('payment_mode')['account_number'],
                    'fk_user_id' => $user->id
                    
                ]
                );
            if($request->input('tax_detail') && $request->input('tax_detail')['tax_free'] == 1) {
                $tax_detail = TaxDetail::create(
                    [
                        'tax_free' => $request->input('tax_detail')['tax_free'],
                        'australian_residence' => $request->input('tax_detail')['australian_residence'],
                        'education_debt' => $request->input('tax_detail')['education_debt'],
                        'financial_debt' => $request->input('tax_detail')['financial_debt'],
                        'additional_information' => $request->input('tax_detail')['additional_information'],
                        'fk_user_id' => $user->id
                        
                    ]
                    );
            }

            $superannuation = Superannuation::create(
                [
                    'fund_name' => $request->input('superannuation')['fund_name'],
                    'account_name' => $request->input('superannuation')['account_name'],
                    'membership_number' => $request->input('superannuation')['membership_number'],
                    'fk_user_id' => $user->id
                ]
                );
            $security_licence = SecurityLicence::create(
                [
                    'license_number' => $request->input('security_license')['license_number'],
                    'expiry' => $request->input('security_license')['expiry'],
                    'certificate' => $request->input('security_license')['certificate'],
                    'fk_user_id' => $user->id
                ]
                );
            $driving_licence = DrivingLicence::create(
                [
                    'license_number' => $request->input('driving_license')['license_number'],
                    'expiry' => $request->input('driving_license')['expiry'],
                    'state' => $request->input('driving_license')['state'],
                    'note' => $request->input('driving_license')['note'],
                    'fk_user_id' => $user->id
                ]
                );
            return response()->json($user, 200);
        }
        return response()->json('wrong', 400);
    }
}
