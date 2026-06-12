<?php

namespace App\Contracts;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommentServiceContract
{
    /**
     * Buat komentar baru pada destinasi/paket. Boleh berupa balasan (threaded)
     * jika $parentId diisi.
     *
     * @param User $user
     * @param string $commentableType "destination" | "package"
     * @param int $commentableId
     * @param string $content
     * @param int|null $parentId ID komentar induk untuk balasan
     * @return Comment
     *
     * @throws \App\Exceptions\InvalidParentCommentException
     */
    public function create(
        User $user,
        string $commentableType,
        int $commentableId,
        string $content,
        ?int $parentId = null
    ): Comment;

    /**
     * Ambil daftar komentar (beserta balasan/nested) untuk suatu konten,
     * sudah difilter dari komentar yang disembunyikan moderasi.
     *
     * @return LengthAwarePaginator
     */
    public function listForContent(string $commentableType, int $commentableId, int $perPage = 20): LengthAwarePaginator;

    /**
     * Update isi komentar (hanya oleh pemilik komentar).
     *
     * @throws \App\Exceptions\UnauthorizedActionException
     */
    public function update(User $user, int $commentId, string $content): Comment;

    /**
     * Hapus komentar (oleh pemilik atau admin).
     *
     * @throws \App\Exceptions\UnauthorizedActionException
     */
    public function delete(User $user, int $commentId): void;

    /**
     * Laporkan komentar sebagai spam / tidak pantas.
     *
     * @param string $reason
     */
    public function report(User $user, int $commentId, string $reason): void;

    /**
     * Moderasi komentar oleh admin: approve, hide, atau delete.
     *
     * @param string $action "approve" | "hide" | "delete"
     *
     * @throws \App\Exceptions\UnauthorizedActionException
     */
    public function moderate(User $admin, int $commentId, string $action): void;

    /**
     * Ambil daftar laporan komentar yang menunggu tindakan admin.
     *
     * @return Collection<int, Comment>
     */
    public function getPendingReports(): Collection;
}
