<?php

namespace App\Controllers;

use App\Models\Admin\AOwnerModel;
use App\Models\LanguageModel;
use App\Models\SettingModel;
use \Config\Services;

$session = \Config\Services::session();
helper(["fonksiyonlar", "curl", "googleTranslate","getUser"]);
class UserAccount extends BaseController
{
    public $data = array();
    public $ownerData;

    public function __construct()
    {
        $Setting    = new SettingModel();
        $AOwner     = new AOwnerModel();
        $this->data["settings"]         = $Setting->getSettings();
        newUser($_SERVER["REQUEST_URI"]);

        if (isset($_SESSION["Fowner"])) {
            if ($AOwner->getOwnerFU($_SESSION["Fowner"])) {
                $this->ownerData = 1;
                $this->data["ownerData"]          = $this->ownerData;
            }
        }
        if(isset($_SESSION["user"])){
            $model = model('UserModel');
            $this->data["userDetails"] = $model->getUser(["email" =>$_SESSION["user"]]);
        }
    }

    public function userAccountForm(){
        $session     = session();
        $userSession = $session->get('user');

        $userInfo    = $this->checkUser(['email' => $userSession]);
        $addressInfo = $this->checkAddress(['userId' => $userInfo['id']]);

        $this->data['userInfo'] = $userInfo;
        $this->data['addressInfo'] = $addressInfo;  

        return view('userAccount', $this->data);
    }

    public function saveUserData(){

        $session = session();
        $userSession    = $session->get('user');
        
        $user = $this->checkUser(['email' => $userSession]);

        $email           = $this->request()->getPost('email');
        $name            = $this->request()->getPost('name');
        $surname         = $this->request()->getPost('surname');
        $telephoneNumber = $this->request()->getPost('telephoneNumber');
        $gender          = $this->request()->getPost('gender');

        $userModel = model('UserModel');
        $userModel->updateUser($user['id'], ['email' => $email, 'name' => $name, 'surname' => $surname, 'telephoneNumber' => $telephoneNumber, 'gender' => $gender]);

        unset($_SESSION['user']);
        $session->set('user', $email);

        header("Location: " . base_url("hesabim-form"));
        exit();

    }

    public function saveUserAddressData($addressId){

        $session = session();
        $userSession    = $session->get('user');
        
        $user = $this->checkUser(['email' => $userSession]);

        $address         = $this->request()->getPost('address');
        $town            = $this->request()->getPost('town');
        $city            = $this->request()->getPost('city');
        $telephoneNumber = $this->request()->getPost('telephoneNumber');

        $model = model('AddressModel');
        $rr = $model->updateAddress($addressId, ['address' => $address, 'town' => $town, 'city' => $city, 'telephoneNumber' => $telephoneNumber]);

        header("Location: " . base_url("hesabim-form"));
        exit();

    }


    // DEPENDENCIES

    public function request()
    {
        return Services::request();
    }

    public function checkUser($where = [])
    {

        $model = model('UserModel');

        $user = $model->getUser($where);

        return empty($user) ? '' : $user;
    }

    public function checkAddress($where = [])
    {

        $model = model('AddressModel');

        $address = $model->getAddress($where);

        return empty($address) ? '' : $address;
    }
}
