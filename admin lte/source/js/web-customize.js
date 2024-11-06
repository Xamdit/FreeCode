var memberApi = "http://52.139.159.116:29100";
var depositApi = "http://52.139.159.116:29200";
$(function () {
	initialElement();
});

let ctrlDown = false;

$(document).keydown(function (e) {
	if (e.keyCode == 17 || e.keyCode == 91) {
		ctrlDown = true;
	}
}).keyup(function (e) {
	if (e.keyCode == 17 || e.keyCode == 91) {
		ctrlDown = false;
	}
	if (e.keyCode == 44) {
		stopPrntScr();
	}
});

$(".no-copy").keydown(function (event) {
	const charCode = (event.which) ? event.which : event.keyCode;
	if (ctrlDown && (charCode == 86 || charCode == 67 || charCode == 88)) {
		return false;
	}
});

document.addEventListener("contextmenu", function (event) {
	event.preventDefault();
}, false);

$('.only-number').on('keypress', function (event) {
	const charCode = (event.which) ? event.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	} else {
		return true;
	}
});

$('.only-currency').on('keyup', function (event) {
	const _regexStr = /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1})|([0]\.[0]{1,2})|(\d*\.)|())$/im;
	if (!_regexStr.test(event.currentTarget.value)) {
		const _str = parseFloat(event.currentTarget.value.substring(0, (event.currentTarget.value.length - 1)));
		event.currentTarget.value = _str ? _str : '0';
	}
});

function stopPrntScr() {
	var inpFld = document.createElement("input");
	inpFld.setAttribute("value", ".");
	inpFld.setAttribute("width", "0");
	inpFld.style.height = "0px";
	inpFld.style.width = "0px";
	inpFld.style.border = "0px";
	document.body.appendChild(inpFld);
	inpFld.select();
	document.execCommand("copy");
	inpFld.remove(inpFld);
}
function AccessClipboardData() {
	try {
		window.clipboardData.setData('text', "Access   Restricted");
	} catch (err) {
	}
}
setInterval("AccessClipboardData()", 300);

function initialElement() {
	// if ($('.datatable').length > 0) {
	//     $('.datatable').DataTable({
	//         bDestroy: true,
	//         responsive: true,
	//         language: {
	//             paginate: {
	//                 previous: '<i class="demo-psi-arrow-left"></i>',
	//                 next: '<i class="demo-psi-arrow-right"></i>'
	//             }
	//         }
	//     });
	// }
	if ($(".date").length > 0) {
		$(".date").datetimepicker({
			format: "YYYY-MM-DD HH:mm"
		});
	}
	$('.form-group.selectpicker').change(function () {
		if ($(this).hasClass('has-error')) {
			$(this).find('.btn-group.bootstrap-select.form-control').find('.btn.dropdown-toggle.btn-default.bs-placeholder').attr('style', 'border-color : #f55a4e !important');
		} else {
			$(this).find('.btn-group.bootstrap-select.form-control').find('.btn.dropdown-toggle.btn-default').removeAttr('style');
		}
	});
}

function validate(fieldName, elements) {
	var faIcon = {
		valid: 'fa fa-check-circle fa-lg text-success',
		invalid: 'fa fa-times-circle fa-lg',
		validating: "fa fa-refresh"
	};
	$(fieldName).bootstrapValidator({
		message: "This value is not valid",
		feedbackIcons: faIcon,
		excluded: [':disabled'],
		fields: elements
	}).on("status.field.bv", function (e, data) {
		e.preventDefault();
		var $parent = data.element.parents(".form-group");
		// Remove the has-success class
		$parent.removeClass("has-success");
	});
	$(fieldName).bootstrapValidator("validate");
	if ($(".has-error").length == 0) {
		return true;
	} else {
		if ($('.form-group.selectpicker').hasClass('has-error')) {
			$('.form-group.selectpicker').find('.btn-group.bootstrap-select.form-control').find('.btn.dropdown-toggle.btn-default.bs-placeholder').attr('style', 'border-color : #f55a4e !important');
		} else {
			$('.form-group.selectpicker').find('.btn-group.bootstrap-select.form-control').find('.btn.dropdown-toggle.btn-default').removeAttr('style');
		}
		return false;
	}
}

function destroy(fieldName) {
	$('.form-group.selectpicker').find('.btn-group.bootstrap-select.form-control').find('.btn.dropdown-toggle.btn-default').removeAttr('style');
	$(fieldName).bootstrapValidator('destroy');
}

function alertMsg(type, msg) {
	if (type && msg) {
		var typeMsg = "";
		if (type.toLowerCase() === "danger") {
			typeMsg = "Danger";
		}
		if (type.toLowerCase() === "warning") {
			typeMsg = "Warning";
		}
		if (type.toLowerCase() === "success") {
			typeMsg = "Success";
		}
		$.niftyNoty({
			type: type.toLowerCase(),
			container: "floating",
			html: "<strong>" + typeMsg + "!</strong> " + msg,
			closeBtn: true,
			floating: {
				position: "top-right",
				animationIn: "jellyIn",
				animationOut: "fadeOut"
			},
			focus: true,
			timer: false ? 0 : 2500
		});
	}
}