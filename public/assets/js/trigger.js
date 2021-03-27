$(document).ready(function() {
				$('.smstriggers').bootstrapValidator({
					fields: {
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