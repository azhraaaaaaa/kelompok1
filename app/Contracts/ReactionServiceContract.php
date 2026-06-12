<?php

namespace App\Contracts;

use App\Models\User;

interface ReactionServiceContract
{
    public const TYPE_LIKE = 'like';
    public const TYPE_DISLIKE = 'dislike';

    /**
     * Berikan / ubah reaksi (like/dislike) pengguna pada sebuah konten.
     *
     * @param User $user
     * @param string $reactableType Nama model, mis. "destination", "package", "review"
     * @param int $reactableId
     * @param string $type "like" | "dislike"
     * @return array{like_count:int, dislike_count:int, user_reaction:?string}
     *
     * @throws \App\Exceptions\InvalidReactionTypeException
     */
    public function react(User $user, string $reactableType, int $reactableId, string $type): array;

    /**
     * Hapus reaksi pengguna pada konten (toggle off).
     *
     * @return array{like_count:int, dislike_count:int, user_reaction:?string}
     */
    public function removeReaction(User $user, string $reactableType, int $reactableId): array;

    /**
     * Ambil ringkasan jumlah like/dislike & reaksi user saat ini untuk konten tertentu.
     *
     * @return array{like_count:int, dislike_count:int, user_reaction:?string}
     */
    public function getSummary(?User $user, string $reactableType, int $reactableId): array;

    /**
     * Ambil daftar preferensi (riwayat like) pengguna untuk keperluan
     * personalisasi rekomendasi liburan.
     *
     * @return array<int, array{reactable_type:string, reactable_id:int, type:string}>
     */
    public function getUserPreferences(User $user): array;
}
