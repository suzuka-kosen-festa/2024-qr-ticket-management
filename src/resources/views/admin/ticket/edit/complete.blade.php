<div>
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        整理券の情報を更新しました。
    </div>

    <x-button.primary-link href={{ route('admin.ticket.edit', ['id' => $ticket->id]) }} text="整理券ページへ戻る" />
</div>
