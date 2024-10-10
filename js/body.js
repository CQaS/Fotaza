$(function () {
    $('body').on('keydown', '#post', function (e) {
        console.log(this.value);
        if (e.which === 32 && e.target.selectionStart === 0) {
            return false;
        }
    });
});

$(function () {
    $('body').on('keydown', '#search', function (e) {
        console.log(this.value);
        if (e.which === 32 && e.target.selectionStart === 0) {
            return false;
        }
    });
});

$(function () {
    $('body').on('keydown', '#comment', function (e) {
        console.log(this.value);
        if (e.which === 32 && e.target.selectionStart === 0) {
            return false;
        }
    });
});
