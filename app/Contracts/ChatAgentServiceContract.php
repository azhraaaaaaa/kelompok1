<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Support\Collection;

interface ChatAgentServiceContract
{
    /**
     * Kirim pesan pengguna ke AI Agent (Claude API) dan dapatkan respons.
     * Riwayat percakapan disimpan agar konteks tetap terjaga.
     *
     * @param User|null $user Null jika guest (gunakan session id)
     * @param string $sessionId Identifier percakapan (untuk guest/anonymous)
     * @param string $message Pesan dari pengguna
     * @return array{
     *   reply: string,
     *   conversation_id: string,
     *   suggestions?: array<int, array{title:string, type:string, ref_id:?int}>
     * }
     *
     * @throws \App\Exceptions\ExternalApiException
     */
    public function sendMessage(?User $user, string $sessionId, string $message): array;

    /**
     * Ambil riwayat percakapan untuk sebuah session/user.
     *
     * @return Collection<int, array{role:string, content:string, created_at:string}>
     */
    public function getHistory(?User $user, string $sessionId): Collection;

    /**
     * Hapus / reset riwayat percakapan.
     */
    public function clearHistory(?User $user, string $sessionId): void;

    /**
     * Minta agent menyusun itinerary perjalanan berdasarkan preferensi pengguna.
     *
     * @param array{
     *   destination: string,
     *   duration_days: int,
     *   budget?: int,
     *   participants?: int,
     *   interests?: array<int,string>,
     * } $preferences
     * @return array{
     *   itinerary: array<int, array{day:int, activities: array<int, array{time:string, activity:string, location:?string}>}>,
     *   estimated_budget: array{currency:string, total:int, breakdown:array<string,int>}
     * }
     *
     * @throws \App\Exceptions\ExternalApiException
     */
    public function generateItinerary(?User $user, array $preferences): array;

    /**
     * Minta agent memberikan estimasi anggaran liburan.
     *
     * @param array{
     *   destination: string,
     *   duration_days: int,
     *   participants: int,
     *   travel_class?: string,
     * } $params
     * @return array{currency:string, total:int, breakdown:array<string,int>}
     *
     * @throws \App\Exceptions\ExternalApiException
     */
    public function estimateBudget(array $params): array;
}
