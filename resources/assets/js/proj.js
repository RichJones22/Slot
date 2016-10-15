// namespace.
var NSProj = {};

var lastTabIndex=-1, currentTabIndex=-1;

// load all javascript once the document is ready.
$(document).ready(function(){
    NSProj.projModal();

    $(window).resize(function () {
        //only do it if the dialog is visible
        if ($('#dialogMessageId').is(":visible")) NSProj.showModal();
    });
});

// modal tabbing control
$('#timeId').on('keydown',function(e) {
    var keyCode = e.keyCode || e.which;

    if (keyCode == 9) {
        if ($('#dialogMessageId').is(":visible")) {
            $('#dialogMessageId').dialog( "destroy" )
        }
    }
});

$('#timeId').focusin(function(e) {

    if ($('#dialogMessageId').is(":visible")) {
        $('#dialogMessageId').dialog( "destroy" )
    }

});

$('#workingOnId').focusin(function(e) {

    if ($('#dialogMessageId').is(":visible")) {
        $('#dialogMessageId').dialog( "destroy" )
    }

});

// restrict tabbing to remain on the current row.
$('#workingOnId').on('keydown',function(e) {
    var keyCode = e.keyCode || e.which;

    if (keyCode == 9) {
        e.preventDefault();
        $('#projectId').focus();
    }
});

$('#dialogMessageId').on('keydown',function(e) {
    var keyCode = e.keyCode || e.which;

    if (keyCode == 9) {
        e.preventDefault();
        if (e.shiftKey )
        {
            $('#workingOnId').focus();
        } else {
            $('#timeId').focus();
        }
    }
});

$('#saveId').on('keydown',function(e) {
    var keyCode = e.keyCode || e.which;

    if (keyCode == 9) {
        e.preventDefault();
        $('#timeId').focus();
    }
});



NSProj.projModal = function() {
    $('#projectId').focusin(function() {
        NSProj.showModal();

        $("#projectDialogId").focus();
    });
};

NSProj.showModal = function() {
    $("#dialogMessageId").dialog({
        modal: false,
        draggable: false,
        resizable: false,
        // responsive: true,
        // clickOut: true,
        // showCloseButton: false,
        position: {
            my: 'left top',
            at: 'left top',
            of: '#projectId'
        },
        // width: 300,
        // height: 50,
        close: function () {
            $('#dialogMessageId').dialog( "destroy" );
        },
        // dialogClass: 'project-dialog',
    }).prev(".ui-dialog-titlebar").css("display","none");
};




















