document.addEventListener('DOMContentLoaded', function () {

    let nganhData = [];
    let tohopData = [];
    // hàm bất đồng bộ để lấy dữ liệu ngành và tổ hợp
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

        // btnSave.onclick = () => {
        //     selects.forEach(s => s.disabled = true);
        //     btnSave.style.display = 'none';
        //     btnEdit.style.display = 'inline-block';
        // };

        // btnEdit.onclick = () => {
        //     selects.forEach(s => s.disabled = false);
        //     btnEdit.style.display = 'none';
        //     btnSave.style.display = 'inline-block';
        // };

        btnDel.onclick = () => {
            row.remove();
        };

        const truongSelect = row.querySelector('.truong');
        const nganhSelect = row.querySelector('.nganh');
        const tohopSelect = row.querySelector('.tohop');
        const sttSelect = row.querySelector('.nv');

        // Đảm bảo các select có name dạng mảng
        truongSelect.name = "Truongs[]";
        nganhSelect.name = "Nganhs[]";
        tohopSelect.name = "ToHop[]";
        sttSelect.name = "STT_NV[]";

        truongSelect.innerHTML = "<option disabled selected>--Chọn trường--</option>";
        const uniqueTruongs = [...new Set(nganhData.map(n => n.TenTruong))];
        uniqueTruongs.forEach(tr => {
            const opt = document.createElement("option");
            opt.value = tr;
            opt.textContent = tr;
            truongSelect.appendChild(opt);
        });

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

            // Tìm đúng ngành theo tên ngành và tên trường
            const nganh = nganhData.find(n => n.Ten_Nganh === tenNganh && n.TenTruong === truong);

            // Reset tổ hợp
            tohopSelect.innerHTML = "<option disabled selected>--Chọn tổ hợp--</option>";

            if (nganh && nganh.Ma_To_Hop) {
                // Tách danh sách mã tổ hợp
                const maToHopArray = nganh.Ma_To_Hop.split(';').map(ma => ma.trim().toUpperCase());

                // Lọc tổ hợp có mã trùng khớp
                const filteredTohop = tohopData.filter(tohop => maToHopArray.includes(tohop.Ma_To_Hop.toUpperCase()));

                // Thêm option hiển thị Tên tổ hợp
                filteredTohop.forEach(tohop => {
                    const opt = document.createElement("option");
                    opt.value = tohop.Ma_To_Hop;
                    opt.textContent = `${tohop.Ma_To_Hop} (${tohop.Ten_To_Hop})`;
                    tohopSelect.appendChild(opt);
                });

                tohopSelect.disabled = false;
            } else {
                tohopSelect.disabled = true;
            }
        });

        document.getElementById('industry-list').appendChild(row);
    }

    // Load dữ liệu rồi thêm dòng đầu tiên
    fetchData();

    document.getElementById('add-btn').addEventListener('click', addRow);
});

