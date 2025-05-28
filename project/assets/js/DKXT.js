document.addEventListener('DOMContentLoaded', function () {
    function addRow() {
      const template = document.getElementById('row-template');
      const clone = template.content.cloneNode(true);
      const row = clone.querySelector('.industry-row');

      const selects = row.querySelectorAll('select');
      const btnSave = row.querySelector('.btn-save');
      const btnEdit = row.querySelector('.btn-set');
      const btnDel = row.querySelector('.btn-del');

      btnSave.onclick = () => {
        selects.forEach(s => s.disabled = true);
        btnSave.style.display = 'none';
        btnEdit.style.display = 'inline-block';
      };

      btnEdit.onclick = () => {
        selects.forEach(s => s.disabled = false);
        btnEdit.style.display = 'none';
        btnSave.style.display = 'inline-block';
      };

      btnDel.onclick = () => row.remove();

      document.getElementById('industry-list').appendChild(row);
    }

    // Thêm một dòng mặc định sau khi DOM đã sẵn sàng
    addRow();

    // Gắn hàm addRow vào nút bấm
    document.getElementById('add-btn').addEventListener('click', addRow);

    document.getElementById('save-all-btn').addEventListener('click', function () {
    const cccd = document.getElementById('cccd').value.trim();
    if (!cccd) {
        alert("Vui lòng nhập CCCD.");
        return;
    }

    const rows = document.querySelectorAll('#industry-list .industry-row');
    const data = [];

    rows.forEach(row => {
        const nv = row.querySelector('.nv').value;
        const truong = row.querySelector('.truong').value;
        const nganh = row.querySelector('.nganh').value;
        const tohop = row.querySelector('.tohop').value;

        data.push({
            Nguyen_Vong: nv,
            TenTruong: truong,
            Ten_Nganh: nganh,
            Ten_To_Hop: tohop
        });
    });

    // Gửi dữ liệu qua PHP bằng fetch/AJAX
    fetch('luu_nguyenvong.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ cccd, nguyệnvong: data })
    })
    .then(res => res.text())
    .then(data => {
        alert(data); // Hoặc hiển thị popup thông báo thành công
    })
    .catch(err => {
        console.error(err);
        alert("Lỗi khi lưu!");
    });
  });
});