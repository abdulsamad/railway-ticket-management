options.handler = function (response) {
	document.getElementById('razorpay_payment_id_ticket').value = response.razorpay_payment_id;
	document.getElementById('razorpay_signature_ticket').value = response.razorpay_signature;

	document.razorpayticketform.submit();
};

options.modal = {
	ondismiss: function () {
		console.log('This code runs when the popup is closed');
	},
};

const rzp2 = new Razorpay(options);

document.getElementById('rzp-ticket-button').onclick = function (ev) {
	ev.preventDefault();
	rzp2.open();
};
