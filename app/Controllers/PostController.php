<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Post;

class PostController extends ResourceController
{
    private $post;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->post = new Post;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $posts = $this->post->orderBy('id', 'desc')->findAll();
        return view('posts/index', compact('posts'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $post = $this->post->find($id);

        if ($post) {
            return view('posts/show', compact('post'));
        }
        else {
            return redirect()->to('/posts');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('posts/create');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $inputs = $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if (!$inputs) {
            return view('posts/create', [
                'validation' => $this->validator
            ]);
        }

        $this->post->save([
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
        ]);

        session()->setFlashdata('success', 'Success! Post created.');
        return redirect()->to(site_url('/posts'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $post = $this->post->find($id);

        if ($post) {
            return view('posts/edit', compact('post'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No post found.');
            return redirect()->to('/posts');
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
            'title' => 'required',
            'description' => 'required',
        ]);

        if (!$inputs) {
            return view('posts/create', [
                'validation' => $this->validator
            ]);
        }

        $this->post->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description')
        ]);

        session()->setFlashdata('success', 'Success! Post updated.');
        return redirect()->to(base_url('/posts'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->post->delete($id);
        session()->setFlashdata('success', 'Success! Post deleted.');
        return redirect()->to(base_url('/posts'));
    }
}
