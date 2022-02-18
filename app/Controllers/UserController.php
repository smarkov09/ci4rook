<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\User;

class UserController extends BaseController
{
    private $user;
    private $session;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->user = new User();
        $this->session = session();
    }

    public function index()
    {
        $users = $this->user->orderBy('id', 'desc')->findAll();
        return view('users/index', compact('users'));
    }

    public function register()
    {
        return view('register');
    }

    public function create()
    {
        $inputs = $this->validate([
            'name' => 'required',
            'email' => 'required|is_unique[users.email]',
            'password' => 'required'
        ]);

        if (!$inputs) {
            return view('register', ['validation' => $this->validator]);
        }

        $this->user->save([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('success', 'Success! Registration completed.');
        return redirect()->to(site_url('/register'));
    }

    public function login()
    {
        if (!session()->get('loggedIn')) {
            //return redirect()->to('/login');
            return view('login');
        }
        else {
            return redirect()->to('dashboard');
        }
    }

    public function loginValidate()
    {
        $inputs = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$inputs) {
            return view('login', [
                'validation' => $this->validator
            ]);
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->user->where('email', $email)->first();

        if ($user) {
            $pass = $user['password'];
            $authPassword = password_verify($password, $pass);

            if ($authPassword) {
                $sessionData = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'loggedIn' => true,
                ];

                $this->session->set($sessionData);
                return redirect()->to('dashboard');
            }

            session()->setFlashdata('failed', 'Failed! Incorrect password.');
            return redirect()->to(site_url('/login'));
        }

        session()->setFlashdata('failed', 'Failed! Incorrect email.');
        return redirect()->to(site_url('/login'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }

    public function show($id = null)
    {
        //$user = $this->user->find($id);

        $data['user'] = $this->user->find($id);

        $ankh = new \App\Models\Ankh();
        $data['usertype'] = $ankh->get_field('name', 'usertypes', $id, 'id');

        if ($data['user']) {
            //return view('users/show', compact('user'));
            return view('users/show', $data);
        }
        else {
            return redirect()->to('/users');
        }
    }

    public function new()
    {
        $usertype = new \App\Models\Usertype();
        $data['usertype'] = $usertype->orderBy('name', 'DESC')->findAll();

        return view('users/create', $data);
    }

    public function create_u()
    {
        $inputs = $this->validate([
            'name' => 'required',
            'email' => 'required|is_unique[users.email]',
            'password' => 'required',
            'phone' => 'required',
            'usertype' => 'required',
        ]);

        if (!$inputs) {
            return view('users/create', [
                'validation' => $this->validator
            ]);
        }

        $this->user->save([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'phone' => $this->request->getVar('phone'),
            'usertype' => $this->request->getVar('usertype')
        ]);

        session()->setFlashdata('success', 'Success! user created.');
        return redirect()->to(site_url('/users'));
    }

}
