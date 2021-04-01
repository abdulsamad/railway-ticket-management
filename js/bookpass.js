options.handler = function (response) {
	document.getElementById('razorpay_payment_id_pass').value = response.razorpay_payment_id;
	document.getElementById('razorpay_signature_pass').value = response.razorpay_signature;

	document.razorpaypassform.submit();
};

options.modal = {
	ondismiss: function () {
		console.log('This code runs when the popup is closed');
	},
};

const rzp1 = new Razorpay(options);

document.getElementById('rzp-pass-button').onclick = function (ev) {
	ev.preventDefault();
	rzp1.open();
};
