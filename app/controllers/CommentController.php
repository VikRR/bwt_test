<?php

namespace bwttest\app\controllers;


use bwttest\app\core\Controller;
use bwttest\app\core\Session;
use bwttest\app\core\Validation;
use bwttest\app\models\Guest;
use ReCaptcha\ReCaptcha;


/**
 * Class CommentController
 *
 * @package bwttest\app\controllers
 */
class CommentController extends Controller
{

    public function index()
    {
        if (!isset($_POST['add_comment'])) {
            if (Session::checkSession()) {
                $this->view->load('form/comment_user');
            } else {
                $this->view->load('form/comment_guest');
            }
        } else {
            $input = $this->view->input('post');

            if ($this->captcha($input)) {
                $this->addComment($input);
            }
            header('Location: comment');
        }
    }

    /**
     * Adding an entry to the comments table
     * If a comment was written by an unregistered user, then his data is entered into the guests table
     * Data from the form is validated
     *
     * @param array $input
     */
    public function addComment($input)
    {
        Validation::checkEmpty($input);

        $model = $this->model->load('comment');

        if (Session::checkSession()) {

            $data['user_id'] = $_SESSION['userid'];

            $data['guest_id'] = null;

            $data['comment'] = $input['comment'];

            $model->insertComment($data);
        } else {
            $data['guest'] = Validation::name(['name' => $input['guest']]);

            $data['email'] = Validation::email($input['email']);

            $guest = new Guest();

            $unique = $guest->uniqueEmail(array($input['email']));

            if ($unique['count'] == 0) {
                $guest->insertGuest($data);
            }

            $data2['user_id'] = null;

            $guest_id = $guest->find([$input['email']]);

            $data2['guest_id'] = $guest_id['id'];

            $data2['comment'] = $input['comment'];

            $model->insertComment($data2);
        }
    }

    /**
     *Checking the reCaptcha
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function captcha($data)
    {
        $secret = '6LcL1hoUAAAAALmPfkNUBEU-OLl9bSBO4S2Glr82';

        $response = null;

        $reCaptcha = new ReCaptcha($secret);

        if ($data['g-recaptcha-response']) {

            $response = $reCaptcha->verify(
                $data['g-recaptcha-response'],
                $_SERVER['REMOTE_ADDR']
            );
        }

        if (!is_null($response) && $response->isSuccess()) {

            return true;
        } else {
            throw new \Exception("Error reCaptcha. $response->getErrorCodes()");
        }
    }

    /**
     * Display all comments
     */
    public function show()
    {
        $model = $this->model->load('comment');

        $user = $model->usersComments();

        $guest = $model->guestsComments();

        $data = array_merge($user, $guest);

        $this->view->load('feedback/index', $data);
    }
}