// src/controllers/auth.controller.js
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const { sequelize } = require('../config/database');
const { Usuario, Paciente } = require('../models'); // Importar los modelos

exports.registerUser = async (req, res) => {
    const { email, password, fecha_nacimiento, ubicacion_zona } = req.body;
    
    // Se inicia la Transacción para asegurar que el usuario y el paciente se creen juntos
    const t = await sequelize.transaction();

    try {
        // 1. Cifrar la Contraseña (RF.1.0)
        const password_hash = await bcrypt.hash(password, 10);
        
        // 2. Crear la entidad USUARIO
        const nuevoUsuario = await Usuario.create({
            email,
            password_hash,
            rol: 'Paciente' // Asignamos el Rol por defecto al registrarse
        }, { transaction: t });

        // 3. Se crea la entidad PACIENTE (Relación 1:1)
        await Paciente.create({
            id_usuario: nuevoUsuario.id_usuario, // Usamos el ID del Usuario recién creado
            fecha_nacimiento,
            ubicacion_zona,
        }, { transaction: t });

        // 4. Verificar que todo este bien para confirmar
        await t.commit(); 

        // Generar JWT para que el usuario pueda iniciar sesión automáticamente
        const token = jwt.sign(
            { id_usuario: nuevoUsuario.id_usuario, rol: 'Paciente' },
            process.env.JWT_SECRET || 'TU_SECRETO_SEGURO', 
            { expiresIn: '1d' }
        );

        res.status(201).json({ 
            message: 'Registro exitoso. Usuario y Paciente creados.', 
            token 
        });

    } catch (error) {
        await t.rollback();
        // Manejar errores de duplicidad (email ya registrado)
        if (error.name === 'SequelizeUniqueConstraintError') {
            return res.status(400).json({ message: 'El correo electrónico ya está registrado.' });
        }
        console.error(error);
        res.status(500).json({ message: 'Error en el servidor al registrar el usuario.' });
    }
};
