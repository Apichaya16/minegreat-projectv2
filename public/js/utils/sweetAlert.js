function showAlertWithConfirm(type, title, msg) {
    return Swal.fire({
            title: title,
            text: msg,
            icon: type,
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
    }).then(result => {
        if (result.isConfirmed) {
            return true;
        }else {
            return false;
        }
    });
}