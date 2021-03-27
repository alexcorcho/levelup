$(document).ready(function() {
				$('#subscriptionsform').bootstrapValidator({
					fields: {
						end_date: {
							validators: {
								notEmpty: {
									message: 'La fecha de finalización es obligatoria y no puede estar vacía.'
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