<?php



namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function retrieve($id);
    public function display();
    public function create($request);
    public function update($request, $id);
    public function view($id);
    public function delete($id);
}