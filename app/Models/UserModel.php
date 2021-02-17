<?php 
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'test_table';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username'];
}