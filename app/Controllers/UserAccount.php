<?php

namespace App\Controllers;

use \Config\Services;

class UserAccount extends BaseController
{

    


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
