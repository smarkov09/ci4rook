<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Module;

class ModuleController extends ResourceController
{
    private $module;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->module = new Module;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $modules = $this->module->orderBy('id', 'desc')->findAll();
        return view('modules/index', compact('modules'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $module = $this->module->find($id);

        if ($module) {
            return view('modules/show', compact('module'));
        }
        else {
            return redirect()->to('/modules');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('modules/create');
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
            return view('modules/create', [
                'validation' => $this->validator
            ]);
        }

        $this->module->save([
            'name' => $this->request->getVar('name')
        ]);

        session()->setFlashdata('success', 'Success! Module created.');
        return redirect()->to(site_url('/modules'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $module = $this->module->find($id);

        if ($module) {
            return view('modules/edit', compact('module'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No data found.');
            return redirect()->to('/modules');
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
            return view('modules/create', [
                'validation' => $this->validator
            ]);
        }

        $this->module->save([
            'id' => $id,
            'name' => $this->request->getVar('name')
        ]);

        session()->setFlashdata('success', 'Success! Module name updated.');
        return redirect()->to(base_url('/modules'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->module->delete($id);
        session()->setFlashdata('success', 'Success! Module deleted.');
        return redirect()->to(base_url('/modules'));
    }
}
