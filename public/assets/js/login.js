$(document).ready(function() {
				$('#loginform').bootstrapValidator({
					fields: {
						email: {
							validators: {
								notEmpty: {
									message: 'La dirección de correo electrónico es obligatoria y no puede estar vacía'
								},
								emailAddress: {
									message: 'La entrada no es una dirección de correo electrónico válida'
								}
							}
						},
						 password: {
            				validators: {
            					notEmpty: {
									message: 'La contraseña es obligatoria y no puede estar vacía'
								},
           					 }
       					 },
					}
			});
			});