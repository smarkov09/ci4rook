<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Program;

class ProgramController extends ResourceController
{
    private $program;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->program = new Program;
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $programs = $this->program->orderBy('id', 'desc')->findAll();
        return view('programs/index', compact('programs'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $program = $this->program->find($id);

        if ($program) {
            return view('programs/show', compact('program'));
        }
        else {
            return redirect()->to('/programs');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('programs/create');
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
            return view('programs/create', [
                'validation' => $this->validator
            ]);
        }

        $this->program->save([
            'name' => $this->request->getVar('name')
        ]);

        session()->setFlashdata('success', 'Success! Program created.');
        return redirect()->to(site_url('/programs'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $program = $this->program->find($id);

        if ($program) {
            return view('programs/edit', compact('program'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No data found.');
            return redirect()->to('/programs');
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
            return view('programs/create', [
                'validation' => $this->validator
            ]);
        }

        $this->program->save([
            'id' => $id,
            'name' => $this->request->getVar('name')
        ]);

        session()->setFlashdata('success', 'Success! Program updated.');
        return redirect()->to(base_url('/programs'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->program->delete($id);
        session()->setFlashdata('success', 'Success! Program deleted.');
        return redirect()->to(base_url('/programs'));
    }
}
