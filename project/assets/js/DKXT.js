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


// Called when a 'Trường' (school) is selected; fetches Ngành (majors)
function getCities(MaTruong) {
  if (MaTruong) {
    let citiesDropDown = document.getElementsByName('cities')[0]; // 'Ngành' dropdown
    let toHopDropDown = document.getElementsByName('Tohop')[0];  // 'Tổ hợp môn' dropdown

    if (MaTruong.trim() === "") {
      citiesDropDown.disabled = true;
      citiesDropDown.innerHTML = '<option value="">Chọn ngành</option>';
      toHopDropDown.disabled = true;
      toHopDropDown.innerHTML = '<option value="">Chọn tổ hợp</option>';
      return;
    }

    fetch(`functions.php?MaTruong=${MaTruong}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
      })
      .then(cities => {
        let out = '<option value="">Chọn ngành</option>';
        for (let city of cities) {
          out += `<option value="${city['MaNganh']}">${city['Ten_Nganh']}</option>`;
        }
        citiesDropDown.innerHTML = out;
        citiesDropDown.disabled = false;

        // Reset "Tổ hợp môn"
        toHopDropDown.innerHTML = '<option value="">Chọn tổ hợp</option>';
        toHopDropDown.disabled = true;
      })
      .catch(error => console.error('Fetch error:', error));
  }
}

// Called when a 'Ngành' (major) is selected; fetches Tổ hợp môn (subject combos)
function getToHop(MaNganh) {
  if (MaNganh) {
    let toHopDropDown = document.getElementsByName('Tohop')[0];

    if (MaNganh.trim() === "") {
      toHopDropDown.disabled = true;
      toHopDropDown.innerHTML = '<option value="">Chọn tổ hợp</option>';
      return;
    }

    fetch(`functions.php?MaNganh=${MaNganh}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
      })
      .then(tohops => {
        let out = '<option value="">Chọn tổ hợp</option>';
        for (let tohop of tohops) {
          out += `<option value="${tohop['MaNganh']}">${tohop['Ma_To_Hop']}</option>`;
        }
        toHopDropDown.innerHTML = out;
        toHopDropDown.disabled = false;
      })
      .catch(error => console.error('Fetch error:', error));
  }
}
