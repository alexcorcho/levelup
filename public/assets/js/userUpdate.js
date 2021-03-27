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
                        }
                    }
            });
            });