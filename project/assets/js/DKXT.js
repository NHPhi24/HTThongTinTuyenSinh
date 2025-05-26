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
  });