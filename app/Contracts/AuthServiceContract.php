<?php

namespace App\Contracts;

use App\Models\User;

interface AuthServiceContract
{
    /**
     * Register user baru dengan email & password.
     *
     * @param array{name:string, email:string, password:string} $data
     * @return User
     */
    public function register(array $data): User;

    /**
     * Login menggunakan email & password.
     * Mengembalikan JWT token jika valid.
     *
     * @param string $email
     * @param string $password
     * @return array{token:string, user:User}
     *
     * @throws \App\Exceptions\InvalidCredentialsException
     */
    public function login(string $email, string $password): array;

    /**
     * Login / register via OAuth provider (Google / Facebook).
     *
     * @param string $provider "google" | "facebook"
     * @param string $oauthToken Token dari provider (id_token / access_token)
     * @return array{token:string, user:User}
     *
     * @throws \App\Exceptions\OAuthAuthenticationException
     */
    public function loginWithProvider(string $provider, string $oauthToken): array;

    /**
     * Verifikasi token JWT dan kembalikan user yang sesuai.
     *
     * @param string $token
     * @return User
     *
     * @throws \App\Exceptions\InvalidTokenException
     */
    public function verifyToken(string $token): User;

    /**
     * Logout / invalidate token JWT.
     */
    public function logout(string $token): void;
}
