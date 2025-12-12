document.addEventListener("DOMContentLoaded", function () {

    const deleteButtons = document.querySelectorAll(".btnDelete");

    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function () {

            let id = this.dataset.id;
            let tenPhim = this.dataset.name;

            Swal.fire({
                title: "Xóa phim?",
                html: `<b class="text-warning">${tenPhim}</b><br>Bạn có chắc chắn muốn xóa phim này?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Xóa ngay",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {

                    // Tạo form gửi request DELETE
                    let form = document.createElement('form');
                    form.action = `/admin/phim/delete/${id}`;
                    form.method = "POST";

                    // CSRF token
                    let token = document.createElement('input');
                    token.type = "hidden";
                    token.name = "_token";
                    token.value = document.querySelector('meta[name="csrf-token"]').content;

                    // Method spoofing DELETE
                    let method = document.createElement('input');
                    method.type = "hidden";
                    method.name = "_method";
                    method.value = "DELETE";

                    form.appendChild(token);
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });

        });
    });

});
