<?php



namespace App\Repositories;

interface UserRepositoryInterface
{
    public function register($request);
    public function login($request);
    public function logout();
    public function profile();
    public function refresh();
    public function displayOrder($orderId);
    public function createNewToken($token);
}