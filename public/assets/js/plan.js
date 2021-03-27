$(document).ready(function() {
				$('#plansform').bootstrapValidator({
					fields: {
						plan_code: {
							validators: {
								notEmpty: {
									message: 'La identificación es obligatoria y no puede estar vacía'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						},
						plan_name: {
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
						status:{
							validators: {
								notEmpty: {
									message: 'El estado es obligatorio y no puede estar vacío'
								}
							}
						},
						plan_details:{
							validators: {
								notEmpty: {
									message: 'Los detalles son obligatorios y no pueden estar vacíos'
								},
								stringLength: {
			                        max: 50,
			                        message: 'Debe tener menos de 50 caracteres.'
			                    }
							}
						},
						days:{
							validators: {
								notEmpty: {
									message: 'El número de días es obligatorio y no puede estar vacío'
								},
							
							regexp: {
									regexp: /^[0-9]+$/,
									message: 'Ingrese un número válido de días'
								}
							}
						},
						amount:{
							validators: {
								notEmpty: {
									message: 'La cantidad es obligatoria y no puede estar vacía.'
								},
							
							regexp: {
									regexp: /^[0-9\.]+$/,
									message: 'Ingrese una cantidad válida'
								}
							}
						}
					
				}
			});
	});

