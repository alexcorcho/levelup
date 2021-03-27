$(document).ready(function() {
				$('#paymentsform').bootstrapValidator({
					fields: {
						payment_amount: {
							validators: {
								notEmpty: {
									message: 'La cantidad es obligatoria y no puede estar vacía.'
								},
							}
						},
						invoice_id: {
							  validators: {
								  notEmpty: {
									message: 'El número de factura es obligatorio y no puede estar vacío'
								}
							}
						},
						date: {
							  validators: {
								  notEmpty: {
									message: 'La fecha de verificación es obligatoria y no puede estar vacía'
								}
							}
						},
						number: {
							  validators: {
								  notEmpty: {
									message: 'El número de cheque es obligatorio y no puede estar vacío.'
								}
							}
						},
					}
				});
			});