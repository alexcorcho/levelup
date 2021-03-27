$(document).ready(function() {
				$('#smseventsform').bootstrapValidator({
					fields: {
						date: {
							validators: {
								notEmpty: {
									message: 'La fecha del evento es obligatoria y no puede estar vacía'
								}
							}
						},
						name: {
							validators: {
								notEmpty: {
									message: 'El nombre es obligatorio y no puede estar vacío'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						},
						message: {
							validators: {
								notEmpty: {
									message: 'El texto del mensaje es obligatorio y no puede estar vacío'
								},
								stringLength: {
			                        max: 420,
			                        message: 'Debe tener menos de 420 caracteres.'
			                    }
							}
						}
					}
				});
			});