<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PortfolioModel;
use CodeIgniter\CodeIgniter;

class PortfolioController extends BaseController
{
    public $helpers = ['form'];
    
    public function index()
    {
        // Mengambil semua data dari table portfolios
        // $model = model('\App\Models\PortfolioModel');
        $model = new PortfolioModel();
        $data['portfolios'] = $model->findAll();

        return view('portfolio/index', $data);
    }
    
    public function create() {
        // helper('form');
        $rules = [
            'title' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Title harus diisi',
                    'min_length' => 'Title setidaknya memiliki 3 karakter'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description harus diisi'
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|ext_in[image,png,jpg,jpeg]',
                'errors' => [
                    'uploaded' => 'Image harus diisi',
                    'ext_in' => 'Image harus berekstensi png, jpg, atau jpeg'
                ]
            ]
        ];

        if($this->request->getMethod() === 'post' && $this->validate($rules)) {
            // Menyimpan file gambar dari input file
            $imageFile = $this->request->getFile('image');
            $imageFileName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/images', $imageFileName);

            // Mengambil data entity portfolio dari request form
            $portfolio = new \App\Entities\PortfolioEntity();
            $portfolio->title = $this->request->getPost('title');
            $portfolio->description = $this->request->getPost('description');
            $portfolio->image = "images/" . $imageFileName;

            // Menyimpan data entity portfolio
            $model = new PortfolioModel();
            $model->save($portfolio);

            return redirect()->to(base_url('/portfolio'))->with('success_message', 'Successfully create a new portfolio');
        }; 

        return view('portfolio/create');
    }

    public function update(int $id) {
        $model = new PortfolioModel();
        $portfolio = $model->find($id);
        if(! $portfolio) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'title' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Title harus diisi',
                    'min_length' => 'Title setidaknya memiliki 3 karakter'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description harus diisi'
                ]
            ],
            'image' => [
                'rules' => 'ext_in[image,png,jpg,jpeg]',
                'errors' => [
                    'ext_in' => 'Image harus berekstensi png, jpg, atau jpeg'
                ]
            ]
        ];

        if($this->request->getMethod() === 'put' && $this->validate($rules)) {
            $imageFile = $this->request->getFile('image');
            $imageFileName = $imageFile->getRandomName();

            if($imageFile->isValid()) {
               // menghapus file gambar sebelumnya
                unlink(ROOTPATH.'public/'.$portfolio->image);

                // menyimpan file gambar baru dari input file 
                $imageFile->move(ROOTPATH.'public/images/', $imageFileName);
                $portfolio->image = "images/".$imageFileName;
            }

            $portfolio->title = $this->request->getPost('title');
            $portfolio->description = $this->request->getPost('description');

            // Jika terdapat perubahan, simpan perubahan data portfolio ke table portfolios
            if($portfolio->hasChanged()) {
                $model->save($portfolio);
            };

            return redirect()->to('/portfolio')->with('success_message', 'Successfully update portfolio');
        }

        $data['portfolio'] = $portfolio;
        return view('portfolio/update', $data);
    }

    public function destroy(int $id) {
        $model = new PortfolioModel();
        $portfolio = $model->find($id);
        if($this->request->getMethod() === 'delete') {
            if(! $portfolio) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $model->delete($portfolio->id);
        }
        return redirect()->to('/portfolio');
    }
}
