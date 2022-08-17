$(function(){
    $('.produk').select2({
        ajax: {
            url: '/backend/cari_produk',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data.produk, function(item){
                        return {
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            },
            cache: true
        }
    });

    $('.produk').on('select2:select', function (e){
        var kode = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari_produk_hasil/' + kode,
            success: function (data){
                $.each(data.produk, function(key, item){
                    $('.id_produk').val(item.id);
                })
            }
        })
    })
})
$(function(){
    $('.customer').select2({
        ajax: {
            url: '/backend/cari_customer',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data.customer, function(item){
                        return {
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            },
        cache: true
        }
    });
    
    $('.customer').on('select2:select', function (e){
        var kode = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari_customer_hasil/' + kode,
            success: function(data){
                $.each(data.customer, function(key, item){
                    $('.id_customer').val(item.id)
                })
            }
        })
    })
})
$(function(){
    $('.paket').select2({
        ajax: {
            url: '/backend/cari_paket_salon',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data.paket, function(item){
                        return {
                            id: item.id,
                            text: item.paket
                        }
                    })
                }
            },
            cache: true
        }
    });

    $('.paket').on('select2:select', function (e){
        var kode = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari_paket_salon_hasil/' + kode,
            success: function (data){
                $.each(data.paket, function(key, item){
                    $('.id_paket').val(item.id);
                })
            }
        })
    })
})
$(function(){
    $('.pegawai').select2({
        ajax: {
            url: '/backend/cari_pegawai',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data.pegawai, function(item){
                        return {
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            },
        cache: true
        }
    });
    
    $('.pegawai').on('select2:select', function (e){
        var kode = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari_pegawai_hasil/' + kode,
            success: function(data){
                $.each(data.pegawai, function(key, item){
                    $('.id_pegawai').val(item.id)
                })
            }
        })
    })
})