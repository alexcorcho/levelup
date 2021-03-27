$(document).ready(function() {
				$('#expensesform').bootstrapValidator({
					fields: {
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
						category_id: {
							validators: {
								notEmpty: {
									message: 'La categoría es obligatoria y no puede estar vacía.'
								}
							}
						},
						amount: {
							validators: {
								notEmpty: {
									message: 'El importe no puede estar vacío.'
								},
								regexp: {
									regexp: /^[0-9\.]+$/,
									message: 'La cantidad solo puede consistir en números y puntos'
								}
							

							}
						}
					
				}
			});
			});