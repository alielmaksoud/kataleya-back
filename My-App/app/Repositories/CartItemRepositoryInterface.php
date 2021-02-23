<?php



namespace App\Repositories;

interface CartItemRepositoryInterface
{
    public function display($id);
    public function create($request);
    public function update($request, $id);
    public function view($id);
    public function delete($id);
}