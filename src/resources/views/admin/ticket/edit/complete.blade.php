<div>
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        チケットの情報を更新しました。
    </div>

    <x-button.primary-link href={{ route('admin.ticket.edit', ['id' => $ticket->id])}} text="チケットページへ戻る" />
</div>
