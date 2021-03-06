<style>
    #add-to-cart {
        background: #fe6600;
        width: auto;
        padding: 5px 25px;
        border-radius: 7px;
        color: #fff;
        border: 1px solid #b3b3b3;
    }

    #add-to-cart:hover {
        background: #ca5100;
        outline: none;
        border-radius: 7px !important;
    }

    #add-to-cart:active,
    #add-to-cart:focus {
        background: #fe6600;
    }
</style>
<script>
    $(document).ready(function() {
        $('.qna-form').submit(function(e) {
            e.preventDefault()
            if (<?= $this->session->userdata(SESSUSER . 'id') ? 1 : 0 ?>) {
                $(this).unbind('submit').submit()
            } else {
                $('#modalAuth').modal('show');
            }
        })
        $('.msg-content-reply').click(function(e) {
            e.preventDefault()
            id = $(this).data('id')
            visible = $('#reply-qna-' + id).is(":visible")
            $('.edit-qna').hide()
            $('.reply-qna').hide()
            if (visible) {
                $('#reply-qna-' + id).fadeOut()
            } else {
                $('#reply-qna-' + id).fadeIn()
            }
        })
        $('.msg-content-edit').click(function(e) {
            e.preventDefault()
            id = $(this).data('id')
            visible = $('#edit-qna-' + id).is(":visible")
            $('.edit-qna').hide()
            $('.reply-qna').hide()
            if (visible) {
                $('#edit-qna-' + id).fadeOut()
            } else {
                $('#edit-qna-' + id).fadeIn()
            }
        })
        $('.msg-content-edit-reply').click(function(e) {
            e.preventDefault()
            id = $(this).data('id')
            visible = $('#edit-qna-' + id).is(":visible")
            $('.edit-qna').hide()
            $('.reply-qna').hide()
            if (visible) {
                $('#edit-qna-' + id).fadeOut()
            } else {
                $('#edit-qna-' + id).fadeIn()
            }
        })
        let star = 0;
        $('.star-input').hover(function() {
            id = $(this).data('id')
            $('.star-input').removeClass('fa-star')
            $('.star-input').removeClass('fa-star-o')
            for (i = 1; i < 6; i++) {
                if (i <= id) {
                    $('#star-' + i).addClass('fa-star')
                } else {
                    $('#star-' + i).addClass('fa-star-o')
                }
            }
        }, function() {
            id = $(this).data('id')
            $('.star-input').removeClass('fa-star')
            $('.star-input').removeClass('fa-star-o')
            for (i = 1; i < 6; i++) {
                if (i <= star) {
                    $('#star-' + i).addClass('fa-star')
                } else {
                    $('#star-' + i).addClass('fa-star-o')
                }
            }
        })
        $('.star-input').click(function() {
            id = $(this).data('id')
            $('.star-input').removeClass('fa-star')
            $('.star-input').removeClass('fa-star-o')
            for (i = 1; i < 6; i++) {
                if (i <= id) {
                    $('#star-' + i).addClass('fa-star')
                } else {
                    $('#star-' + i).addClass('fa-star-o')
                }
            }
            star = id
            $('#star-input').val(star)
        })
        $('#btn-discuss-input-camera').click(function(e) {
            e.preventDefault()
            $('#image-review').click()

        })
        $('#btn-sub-qty').click(function(e) {
            e.preventDefault()
            val = parseInt($('#btn-qty').data('value'))
            i = val < 2 ? 1 : val - 1
            parseInt($('#btn-qty').data('value', i))
            parseInt($('#btn-qty').html(i))
        })
        $('#btn-add-qty').click(function(e) {
            e.preventDefault()
            val = parseInt($('#btn-qty').data('value'))
            i = val > 19 ? 20 : val + 1
            parseInt($('#btn-qty').data('value', i))
            parseInt($('#btn-qty').html(i))
        })
        $('#form-review').submit(function(e) {
            e.preventDefault()
            qualified = $(this).data('qualified')
            if (qualified) {
                Swal.fire({
                    icon: 'success',
                    text: 'Review produk berhasil',
                    showConfirmButton: false,
                    timer: 1500,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                })
                setTimeout(() => {
                    $(this).unbind('submit').submit()
                }, 1500);
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Silahkan beli produk untuk menilai',
                    showConfirmButton: false,
                    timer: 1500,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                })
            }
        })
        $('#add-to-cart-form').submit(function(e) {
            e.preventDefault()
            if (<?= $this->session->userdata(SESSUSER . 'id') !== null ? 1 : 0 ?>) {
                produk_id = $(this).data('id')
                qty = $('#btn-qty').data('value')
                checkall = true
                variasi = []
                $('.parent-variasi').each(function() {
                    id = $(this).data('id')
                    if ($('.variasi-' + id + ':checked').length != 1) {
                        checkall = false
                    } else {
                        variasi.push($('.variasi-' + id + ':checked').val())
                    }
                })
                if (checkall) {
                    $.ajax({
                        method: 'post',
                        dataType: 'json',
                        url: "<?= base_url() ?>add_to_cart/" + produk_id + "/" + qty,
                        data: {
                            variasi: variasi
                        },
                        success: function(res) {
                            console.log(res)
                            if (res == "true") {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Produk ditambahkan kedalam keranjang',
                                    showConfirmButton: false,
                                    timer: 0,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                    },
                                })
                                setTimeout(() => {
                                    window.location.href = '<?= base_url() ?>checkout'
                                }, 1000);
                            } else if (res == "merchant") {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Produk ini milik toko anda',
                                    showConfirmButton: false,
                                    timer: 1000,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                    },
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Produk tidak valid',
                                    showConfirmButton: false,
                                    timer: 1000,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                    },
                                })
                            }
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Silahkan pilih variasi terlebih dahulu',
                        showConfirmButton: false,
                        timer: 1000,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    })
                }
            } else {
                $('#modalAuth').modal('show');
            }
        })
    })
</script>