$(document).ready(function() {
				$('#settingsform').bootstrapValidator({
					fields: {
						primary_contact: {
							validators: {
								regexp: {
									regexp: /^[0-9\.]+$/,
									message: 'La entrada no es un número válido.'
								},
								stringLength: {
			                        max: 10,
			                        message: 'Debe tener menos de 10 caracteres.'
			                    }
							}
						}
					}
				});
			});