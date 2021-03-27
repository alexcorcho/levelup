$(document).ready(function() {
				$('#usersform').bootstrapValidator({
					fields: {
						name: {
							validators: {
								notEmpty: {
									message: 'El nombre es obligatorio y no puede estar vacío'
								}
							}
						},
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
								stringLength: {
			                        min: 6,
			                        message: 'La contraseña debe tener al menos 6 caracteres'
			                    },
                				identical: {
                   				 field: 'password_confirmation',
                   				 message: 'La contraseña y su confirmación no son las mismas.'
               					 }
           					 }
       					 },
						password_confirmation: {
           					 validators: {
           					 	notEmpty: {
									message: 'Se requiere confirmación de contraseña y no puede estar vacía'
								},
               					 identical: {
                   					field: 'password',
                   					message: 'La contraseña y su confirmación no son las mismas.'
               				    }
            				}
        				}
					}
			});
			});