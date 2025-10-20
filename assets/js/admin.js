(function($){
    function render(json){
        $('#bwci-json').val(JSON.stringify(json, null, 2));
    }
    $('#bwci-export').on('click', function(e){
        e.preventDefault();
        $.post(BWCI.ajax, { action: 'bwci_export', nonce: BWCI.nonce }, function(resp){
            if(resp && resp.success){ render(resp.data); }
        });
    });
    $('#bwci-copy').on('click', function(){
        var $t = $('#bwci-json'); $t.focus(); $t.select();
        try { document.execCommand('copy'); } catch(e) {}
    });
})(jQuery);