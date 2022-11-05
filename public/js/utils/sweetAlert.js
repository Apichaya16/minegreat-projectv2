function showAlertWithConfirm(type, title, msg) {
    return Swal.fire({
            title: title,
            text: msg,
            icon: type,
            confirmButtonText: 'ตกลง',
            denyButtonText: 'ยกเลิก',
            showDenyButton: true,
    }).then(result => {
        if (result.isConfirmed) {
            return true;
        }else {
            return false;
        }
    });
}
function showAlert(type, title, msg) {
    Swal.fire({
        title: title,
        text: msg,
        icon: type,
        confirmButtonText: 'ตกลง'
    });
}
function showLoading(title = 'Loading...') {
    Swal.fire({
        title: title,
        didOpen: () => {
            Swal.showLoading();
        }
    })
}
function hideLoading() {
    Swal.close();
}
