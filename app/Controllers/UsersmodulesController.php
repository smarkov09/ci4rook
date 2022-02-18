<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Usersmodules;
use App\Models\Usertype;
use App\Models\Module;

class UsersmodulesController extends BaseController
{
    private $usermodule;
    private $utype;
    private $data = array();

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->usermodule = new Usersmodules;
        $this->utype = new Usertype;
    }

    public function edit($id = null)
    {
        $utype = $this->utype->find($id);
        //$this->data['ums'] = $this->usermodule->where('usertype_id', $utype['id'])->findAll();
        /*echo $utype['id'];
        die();*/
        $this->data['ums'] = $this->usermodule->fetch_users_modules($utype['id']);
        $this->data['utype'] = $utype;

        if ($utype) {
            //return view('usersmodules/check', compact('utype'));
            return view('usersmodules/check', $this->data);
        }
        else {
            session()->setFlashdata('failed', 'Alert! No data found.');
            return redirect()->to('/usertypes');
        }
    }

    public function check()
    {
        $checks = [
            'cbxr' => $this->request->getPost('rprop'),
            'cbxc' => $this->request->getPost('cprop'),
            'cbxu' => $this->request->getPost('uprop'),
            'cbxd' => $this->request->getPost('dprop'),
            'cbxp' => $this->request->getPost('pprop')
        ];

        $chkjson = json_encode($checks);

        var_dump($checks);
        echo '<br>';
        echo $chkjson;
    }
}
