<?php

namespace bwttest\app\controllers;

use bwttest\app\core\Controller;
use bwttest\app\core\Session;
use bwttest\app\core\Validation;

/**
 * Class AuthController
 *
 * @package bwttest\app\controllers
 */
class AuthController extends Controller
{

    /**
     * Registration
     *
     * @throws \Exception
     *
     * @return void
     */
    public function registration()
    {
        $model = $this->model->load('user');

        if (isset($_POST['reg'])) {
            $input = $this->view->input('post');

            $input = Validation::checkEmpty($input);

            $data['first_name'] = Validation::name(['first name' => $input['first_name']]);

            $data['last_name'] = Validation::name(['last name' => $input['last_name']]);

            Validation::email($input['email']);

            $email = $model->uniqueEmail([$input['email']]);

            if ($email['count'] == 0) {
                $data['email'] = $input['email'];
            } else {
                throw new \Exception('Email is not unique, please enter another.');
            }

            $data['password'] = Validation::password($input['password'], $input['repeat_password']);

            $data['male'] = '';

            $input['male'] = strtolower($input['male']);

            if (!empty($input['male'])) {
                ($input['male'] === 'male') ? $data['male'] = true : $data['male'] = false;
            }

            $birthday = Validation::date($input['birthday']);

            $data['birthday'] = $birthday;

            $model->insertUser($data);

            header('Location: login');

        } else {
            throw new \Exception('The registration form was not sent.');
        }
    }

    /**
     * Login
     *
     * @throws \Exception
     *
     * @return void
     */
    public function login()
    {
        if (!isset($_POST['log'])) {
            $this->view->load('form/login');
        } else {
            $input = $this->view->input('post');

            $model = $this->model->load('user');

            $user = $model->login(['email' => $input['email']]);

            if (count($user) === 0) {
                throw new \Exception('Email is not correct, please enter another email.');
            }

            if (!password_verify($input['password'], $user['password'])) {
                throw new \Exception('Password is not correct.');
            } else {
                $username = $user['first_name'] . ' ' . $user['last_name'];

                $data ['username'] = $username;

                $data['userid'] = $user['id'];

                Session::add($data);

                header('Location: weather');
            }
        }
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        Session::stop();
        header('Location: /');
    }
}