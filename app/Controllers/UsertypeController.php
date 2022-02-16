<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Usertype;

class UsertypeController extends ResourceController
{
    private $utype;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->utype = new Usertype;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $usertypes = $this->utype->orderBy('id', 'desc')->findAll();
        return view('usertypes/index', compact('usertypes'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $utype = $this->utype->find($id);

        if ($utype) {
            return view('usertypes/show', compact('utype'));
        }
        else {
            return redirect()->to('/usertypes');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('usertypes/create');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $inputs = $this->validate([
            'name' => 'required',
        ]);

        if (!$inputs) {
            return view('usertypes/create', [
                'validation' => $this->validator
            ]);
        }

        $this->utype->save([
            'name' => $this->request->getVar('name')
        ]);

        session()->setFlashdata('success', 'Success! User type created.');
        return redirect()->to(site_url('/usertypes'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $utype = $this->utype->find($id);

        if ($utype) {
            return view('usertypes/edit', compact('utype'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No data found.');
            return redirect()->to('/usertypes');
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $inputs = $this->validate([
            'name' => 'required'
        ]);

        if (!$inputs) {
            return view('usertypes/create', [
                'validation' => $this->validator
            ]);
        }

        $this->utype->save([
            'id' => $id,
            'name' => $this->request->getVar('name')
        ]);

        session()->setFlashdata('success', 'Success! User type updated.');
        return redirect()->to(base_url('/usertypes'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->utype->delete($id);
        session()->setFlashdata('success', 'Success! User type deleted.');
        return redirect()->to(base_url('/usertypes'));
    }
}
