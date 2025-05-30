document.addEventListener('DOMContentLoaded', function () {
    
    let nganhData = [];
    let tohopData = [];

    async function fetchData() {
        const response = await fetch('./auth/api_nganh_tohop.php');
        const data = await response.json();
        nganhData = data.nganhs;
        tohopData = data.tohops;

        // Thêm 1 dòng mặc định khi dữ liệu đã load xong
        addRow();
    }

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

        btnDel.onclick = () => {
            row.remove();
        };

        const truongSelect = row.querySelector('.truong');
        const nganhSelect = row.querySelector('.nganh');
        const tohopSelect = row.querySelector('.tohop');

        truongSelect.addEventListener("change", function () {
            const tenTruong = this.value;
            const filteredNganh = nganhData.filter(n => n.TenTruong === tenTruong);
            
            nganhSelect.innerHTML = "<option disabled selected>--Chọn ngành--</option>";
            const uniqueNganhs = [...new Set(filteredNganh.map(n => n.Ten_Nganh))];
            uniqueNganhs.forEach(tn => {
                const opt = document.createElement("option");
                opt.value = tn;
                opt.textContent = tn;
                nganhSelect.appendChild(opt);
            });

            tohopSelect.innerHTML = "<option disabled selected>--Chọn tổ hợp--</option>";
        });

        nganhSelect.addEventListener("change", function () {
            const tenNganh = this.value;
            const truong = truongSelect.value;

            const nganh = nganhData.find(n => n.Ten_Nganh === tenNganh && n.TenTruong === truong);

            tohopSelect.innerHTML = "<option disabled selected>--Chọn tổ hợp--</option>";

            if (nganh) {
                const maToHopArray = nganh.Ma_To_Hop.split(';').map(s => s.trim());
                const filteredTohop = tohopData.filter(t => maToHopArray.includes(t.Ma_To_Hop));

                filteredTohop.forEach(t => {
                    const opt = document.createElement("option");
                    opt.value = t.Ten_To_Hop;
                    opt.textContent = t.Ten_To_Hop;
                    tohopSelect.appendChild(opt);
                });
            }
        });


        document.getElementById('industry-list').appendChild(row);
    }

    // Load dữ liệu rồi thêm dòng đầu tiên
    fetchData();

    // Mỗi lần bấm nút "Thêm nguyện vọng" chỉ gọi addRow() một lần thôi
    document.getElementById('add-btn').addEventListener('click', addRow);
});
