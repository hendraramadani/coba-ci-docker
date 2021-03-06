<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;


class User extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index(){
      $model = new UserModel();
      $data['users'] = $model->orderBy('id', 'ASC')->findAll();
      return $this->respond($data);
    }

    // create
    public function create() {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),
        ];
        $model->insert($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'User created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }

    // single user
    public function show($id = null){
        $model = new UserModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No User found');
        }
    }

    // update
    public function update($id = null){
        $model = new UserModel();
        $data = [
            'id' => $id,
            'username' => $this->request->getVar('username'),
        ];
        $model->update($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'User updated successfully'
          ]
      ];
      return $this->respond($data);
    }

    // delete
    public function delete($id = null){
        $model = new UserModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'User successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No User found');
        }
    }

}