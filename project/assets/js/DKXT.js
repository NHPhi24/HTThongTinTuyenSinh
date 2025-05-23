function createSelect(options) {
      const select = document.createElement('select');
      options.forEach(opt => {
        const option = document.createElement('option');
        option.value = opt;
        option.textContent = opt;
        select.appendChild(option);
      });
      return select;
    }

    function addRow() {
      const row = document.createElement('div');
      row.className = 'industry-row';

      const selectNV = createSelect(Array.from({ length: 20 }, (_, i) => (i + 1).toString().padStart(2, '0')));
      const selectTruong = createSelect(['ĐH Bách Khoa', 'ĐH Kinh tế', 'ĐH Mỏ Địa chất', 'ĐH Công nghiệp']);
      const selectIndustry = createSelect(['Công nghệ thông tin', 'Tự động hóa', 'Quản trị kinh doanh', 'Kế toán', 'Khai thác mỏ']);
      const selectToHop = createSelect(['A00', 'A01', 'C00', 'C01', 'B', 'D01']);

      const selects = [selectNV, selectTruong, selectIndustry, selectToHop];
      
      const crud = document.createElement('div');
      crud.className = 'crud';

      const btnSave = document.createElement('button');
      btnSave.className = 'btn btn-save';
      btnSave.innerHTML = '<i class="fa-solid fa-check"></i>';
      btnSave.onclick = () => {
        selects.forEach(s => s.disabled = true);
        btnSave.style.display = 'none';
        btnEdit.style.display = 'inline-block';
      };

      const btnEdit = document.createElement('button');
      btnEdit.className = 'btn btn-set';
      btnEdit.innerHTML = '<i class="fa-solid fa-gear"></i>';
      btnEdit.style.display = 'none';
      btnEdit.onclick = () => {
        selects.forEach(s => s.disabled = false);
        btnEdit.style.display = 'none';
        btnSave.style.display = 'inline-block';
      };

      const btnDel = document.createElement('button');
      btnDel.className = 'btn btn-del';
      btnDel.innerHTML = '<i class="fa-solid fa-xmark"></i>';
      btnDel.onclick = () => row.remove();

      crud.appendChild(btnSave);
      crud.appendChild(btnEdit);
      crud.appendChild(btnDel);

      row.appendChild(selectNV);
      row.appendChild(selectTruong);
      row.appendChild(selectIndustry);
      row.appendChild(selectToHop);
      row.appendChild(crud);

      document.getElementById('industry-list').appendChild(row);
    }

    addRow();