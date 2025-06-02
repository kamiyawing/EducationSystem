
//行追加
let deliveryIndex = document.querySelectorAll('.row.align-items-center').length;

window.add = function () {
    const container = document.getElementById('delivery-container');

    const row = document.createElement('div');
    row.className = 'row align-items-center g-2 mt-2';

    row.innerHTML = `
      <div class="col-auto">
        <input type="date" class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" 
               name="delivery_times[${deliveryIndex}][from_date]" placeholder="年月日">
      </div>

      <div class="col-auto">
        <input type="time" class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" 
               name="delivery_times[${deliveryIndex}][from_time]" placeholder="時間">
      </div>

      <div class="col-auto">
        <span class="fs-3">　～　</span>
      </div>

      <div class="col-auto">
        <input type="date" class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" 
               name="delivery_times[${deliveryIndex}][to_date]" placeholder="年月日">
      </div>

      <div class="col-auto">
        <input type="time" class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" 
               name="delivery_times[${deliveryIndex}][to_time]" placeholder="時間">
      </div>

      <div class="col-auto">
        <button type="button" class="btn btn-danger" onclick="this.closest('.row').remove()">削除</button>
      </div>
    `;

    container.appendChild(row);
    deliveryIndex++;
};


//行削除
document.addEventListener('DOMContentLoaded', function () {
    // .delete-btn をすべて取得してループ
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            // 押されたボタンから、data-id を取得
            const deliveryId = this.dataset.id;
            const deliveryUrl = this.dataset.url;

            // 確認ダイアログ
            if (!confirm('本当に削除しますか？')) return;

            // fetch で DELETEリクエスト送信
            fetch(deliveryUrl, {
                method: 'DELETE',
                headers: {
                    // CSRFトークン（metaから取得）
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
                .then(response => {
                    if (response.ok) {
                        // 成功 → 該当の行（div.row）を画面から削除
                        this.closest('.row').remove();
                    } else {
                        alert('削除に失敗しました');
                    }
                })
                .catch(error => {
                    console.error('削除エラー:', error);
                    alert('通信エラーが発生しました');
                });
        });
    });
});