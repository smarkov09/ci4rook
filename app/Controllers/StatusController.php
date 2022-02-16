<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Status;

class StatusController extends ResourceController
{
    private $state;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->state = new Status;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $status = $this->state->orderBy('id', 'desc')->findAll();
        return view('status/index', compact('status'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $state = $this->state->find($id);

        if ($state) {
            return view('status/show', compact('state'));
        }
        else {
            return redirect()->to('/status');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('status/create');
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
            'color' => 'required'
        ]);

        if (!$inputs) {
            return view('status/create', [
                'validation' => $this->validator
            ]);
        }

        $this->state->save([
            'name' => $this->request->getVar('name'),
            'color' => $this->request->getVar('color')
        ]);

        session()->setFlashdata('success', 'Success! Status created.');
        return redirect()->to(site_url('/status'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $state = $this->state->find($id);

        if ($state) {
            return view('status/edit', compact('state'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No data found.');
            return redirect()->to('/status');
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
            'name' => 'required',
            'color' => 'required'
        ]);

        if (!$inputs) {
            return view('status/create', [
                'validation' => $this->validator
            ]);
        }

        $this->state->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'color' => $this->request->getVar('color')
        ]);

        session()->setFlashdata('success', 'Success! Status updated.');
        return redirect()->to(base_url('/status'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->state->delete($id);
        session()->setFlashdata('success', 'Success! Status deleted.');
        return redirect()->to(base_url('/status'));
    }
}
