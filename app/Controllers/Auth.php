<?php

namespace App\Controllers;

use App\Models\Admin\AOwnerModel;
use App\Models\SettingModel;
use \Config\Services;

helper(["fonksiyonlar", "curl", "googleTranslate","getUser", "mail"]);
$session = \Config\Services::session();
class Auth extends BaseController
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
            $this->data["userDetails"] = $model->getUser(["email" => $_SESSION["user"]]);
        }
    }

    public function loginForm()
    {
        return view('login', $this->data);
    }

    public function signupForm()
    {
        return view('signup', $this->data);
    }

    public function sifremiUnuttumForm()
    {
        return view('sifremiUnuttum', $this->data);
    }

    public function sifreYenileForm($email, $activationCode)
    {
        $data[] = ['email' => $email, 'activationCode' => $activationCode];

        $user = $this->checkUser($data);

        if (empty($user)) {
            $alert = [
                'title' => 'İşlem Başarısız',
                'description' => 'Kullanıcı bulunamadı',
                'type' => 'error'
            ];
            $session = session();
            $session->set('alert', $alert);

            return redirect()->to(base_url('login'));
        }
        $this->data["email"] = $email;
        $this->data["activationCode"] = $activationCode;

        return view('sifreYenile', $this->data);
    }

    public function login()
    {
        $email    = $this->request()->getPost('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = md5($this->request()->getPost('password'));

        $user = $this->checkUser(['email' => $email, 'password' => $password]);
        $session = session();

        if (empty($user)) {
            $alert = [
                'title' => 'İşlem Başarısız',
                'description' => 'Kullanıcı bulunamadı',
                'type' => 'error'
            ];
            $session->set('alert', $alert);

            return redirect()->to(base_url('login'));
        }

        // If activation code didn't confirm
        $checkActivation = $this->checkUser(['email' => $email, 'status' => 0]);

        $model = model('UserModel');

        $activationCode = $this->generateActivationCode();

        if (!empty($checkActivation)) {
            $model->updateUser($checkActivation['id'], ['activationCode' => $activationCode]);
            return $this->sendActivationCodeMail('aktivasyon-yenile', $checkActivation['email'], $activationCode);
        }

        $model->updateUser($user['id'], ['activationCode' => $activationCode]);

        $session->set('user', $email);

        return redirect()->to(base_url('/'));
    }

    public function signup()
    {

        $email = $this->request()->getPost('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $user =  $this->checkUser(['email' => $email]);

        if (!empty($user)) {
            $alert = [
                'title' => 'İşlem Başarısız',
                'description' => 'Kullanıcı mevcut.',
                'type' => 'error'
            ];

            $session = session();
            $session->set('alert', $alert);

            return redirect()->to(base_url('signup'));
        }

        $password              = md5($this->request()->getPost('password'));
        $name                  = $this->request()->getPost('name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $surname               = $this->request()->getPost('surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $telephoneNumber       = $this->request()->getPost('telephoneNumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender                = $this->request()->getPost('gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $registrationDate      = time();
        $registrationIpAddress = $_SERVER['REMOTE_ADDR'];
        $activationCode        = $this->generateActivationCode();

        $model = model('UserModel');
        $model->addUser([
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'surname' => $surname,
            'telephoneNumber' => $telephoneNumber,
            'gender' => 'deneme',
            'registrationDate' => $registrationDate,
            'registrationIpAddress' => $registrationIpAddress,
            'activationCode' => $activationCode,
            'gender' => $gender
        ]);

        return $this->sendActivationCodeMail('aktivasyon-onayla', $email, $activationCode);
    }

    public function sifremiUnuttum()
    {

        $email = $this->request()->getPost('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $user = $this->checkUser(['email' => $email]);

        if (empty($user)) {
            $alert = [
                'title' => 'İşlem Başarısız',
                'description' => 'Kullanıcı bulunamadı',
                'type' => 'error'
            ];
            $session = session();
            $session->set('alert', $alert);

            return redirect()->to(base_url('sifremi-unuttum-form'));
        }

        return $this->sendActivationCodeMail('sifremi-unuttum', $email, $user['activationCode']);
    }

    public function sifreYenile($email, $activationCode)
    {

        $password = md5($this->request()->getPost('password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $user = $this->checkUser(['email' => $email, 'activationCode' => $activationCode]);

        $model = model('UserModel');
        $model->updateUser($user['id'], ['password' => $password, 'status' => 1, 'activationCode' => $this->generateActivationCode()]);

        $alert = [
            'title' => 'Şifre Yenileme',
            'description' => 'Yeni şifreniz başarıyla oluşturuldu.',
            'type' => 'warning'
        ];

        $session = session();
        $session->set('alert', $alert);

        return redirect()->to(base_url('login'));
    }

    public function logout(){
        session_destroy();
        return redirect()->to(base_url('/'));
    }


    // DEPENDENCIES
    public function confirmActivation($email, $activationCode)
    {

        $user = $this->checkUser(['email' => $email]);

        if (empty($user)) {
            $alert = [
                'title' => 'İşlem Başarısız',
                'description' => 'Kullanıcı mevcut değil.',
                'type' => 'error'
            ];

            $session = session();
            $session->set('alert', $alert);

            return redirect()->to(base_url('login'));
        }

        $model = model('UserModel');
        $update = $model->updateUser($user['id'], ['activationCode' => $activationCode, 'status' => 1]);

        $session = session();
        $session->set('user', $email);

        return $update == 1 ? redirect()->to(base_url('/')) : redirect()->to(base_url('login'));
    }

    public function request()
    {
        return Services::request();
    }

    public function generateActivationCode()
    {
        $segments = [];
        for ($i = 0; $i < 4; $i++) {
            $segment = '';
            for ($j = 0; $j < 5; $j++) {
                $segment .= mt_rand(0, 9);
            }
            $segments[] = $segment;
        }
        return implode('-', $segments);
        // return substr(md5(uniqid(time())), 0, 10);
    }

    public function sendActivationCodeMail($process, $email, $activationCode)
    {

        // localhost:8080/aktivasyon-onayla/$email/$activationCode
        // localhost:8080/aktivasyon-yenile/$email/$activationCode
        // localhost:8080/sifremi-unuttum/$email/$activationCode
        $sendActivationCodeMail = true;
        $Message = "
            Şifrenizi yenileme linkiniz aşağıdadır.
            <a href=" . base_url("sifre-yenile/$email/" . $activationCode) . "> Buraya Tıkla </a>
        ";  
        
        if(mailSendHelper("Şifre Yenileme", $Message, $email)){
            $sendActivationCodeMail = true;
        }else{
            $sendActivationCodeMail = true; // Sistem çalışmadığında ötürü yama
        }

        $session = session();

        if ($sendActivationCodeMail != true) {
            $alert = [
                'title' => 'İşlem Başarısız',
                'description' => 'Bir hata oluştu. Tekrar deneyin.',
                'type' => 'error'
            ];

            $session->set('alert', $alert);

            return redirect()->to(base_url('login'));
        }

        switch ($process) {

            case 'aktivasyon-onayla':
                $alert = [
                    'title' => 'Aktivasyon Kodu',
                    'description' => 'Aktivasyon kodunuzu onaylamalısınız. Mail kutunuzu kontrol edin.',
                    'type' => 'warning'
                ];
                $session->set('alert', $alert);

                return redirect()->to(base_url('signup'));
                break;

            case 'aktivasyon-yenile':
                $alert = [
                    'title' => 'Aktivasyon Kodu',
                    'description' => 'Aktivasyon kodunuzu onaylamalısınız. Mail kutunuzu kontrol edin.',
                    'type' => 'warning'
                ];
                $session->set('alert', $alert);

                return redirect()->to(base_url('login'));
                break;

            case 'sifremi-unuttum':
                $alert = [
                    'title' => 'Şifre Yenile',
                    'description' => 'Mail kutunuzdaki link ile şifre yenileme sayfasına yönlendirileceksiniz.',
                    'type' => 'warning'
                ];
                $session->set('alert', $alert);

                // return redirect()->to(base_url("sifre-yenile-form/$email/$activationCode"));
                return redirect()->to(base_url("login"));
                break;
        }

        return redirect()->to(base_url('login'));
    }

    public function checkUser($where = [])
    {

        $model = model('UserModel');

        $user = $model->getUser($where);

        return empty($user) ? '' : $user;
    }
}
